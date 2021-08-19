<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeoIP as GeoIP;

class Asset extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    /**
     * Returns the contributors for that Asset
     *
     * @return \App\Contributor
     */
    public function contributors()
    {
        return $this->hasMany('App\Contributor');
    }

    /**
     * Returns the Categories for that Asset
     *
     * @return \App\Category
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }


    /**
     * Returns Images for that Asset
     *
     * @return \App\Image
     */
    public function images()
    {
        return $this->hasMany('App\AssetImage');
    }

    /**
     * Returns the available Renderings for that Asset
     *
     * @return \App\Rendiring
     */
    public function renderings()
    {
        return $this->belongsToMany('App\Rendering');
    }

    public function sales()
    {
        return $this->morphToMany('App\Sale', 'sellable')->withTimestamps()->withPivot('id', 'cantidad', 'precio', 'url');
    }

    /**
     * Return the display Img
     *
     * @return Route
     */
    public function getImg()
    {
        $imgs = $this->images()->get();
        $type = \App\ImageType::find($imgs[1]->image_type_id);

        return 'https://'.$type->path.$imgs[1]->image;
    }


    /**
     * Returns the actual price in CLP
     *
     * @return Int
     */
    public function getPriceAttribute($value)
    {
        if((null != setting('tasa_cambio')) && floatval(setting('tasa_cambio') > 0)) {
            return round($value * floatval(setting('tasa_cambio')));
        }
        return round($value * (787.427));
    }

    /**
     * Returns the display price in CLP
     *
     * @return Int
     */
    public function getDisplayPriceAttribute($value)
    {
        return  '$' . number_format($this->price);
    }

    public function openTransaction($sale)
    {
        $price = floatval(number_format($this->price / (setting('tasa_cambio') ?? 787.427), 2));
        $location = GeoIP::getLocation();
        $code = $location['iso_code'];
        $lineId = \DB::table('sellables')->select('id')->where('sale_id', $sale->id)->where('sellable_type', 'App\Asset')->where('sellable_id', $this->id)->first()->id;
        $xml = "<?xml version='1.0' encoding='UTF-8' standalone='no'?>
<!DOCTYPE DAMRequest SYSTEM 'https://haldms.halleonard.com/dam_dtd/DAMRequestVersion5.dtd'>
<DAMRequest>
    <RequestHdr>
        <DAMVersion>5.0</DAMVersion>
        <VendorId>347</VendorId>
        <VendorKey>4Z_w47U.kY</VendorKey>
    </RequestHdr>
    <TransactionOpenRequest>
        <VendorLineItem>
            <AssetId>{$this->id}</AssetId>
            <OrderNumber>{$sale->id}</OrderNumber>
            <CountryCode>{$code}</CountryCode>
            <UnitPrice>{$price}</UnitPrice>
            <OrderLineId>{$lineId}</OrderLineId>
        </VendorLineItem>
    </TransactionOpenRequest>
</DAMRequest>";

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://haldms.halleonard.com/dam', [
            'headers' => [
                'Content-Type' => 'text/xml'
            ],
            'body' => $xml
        ])->getBody()->getContents();

        $data = simplexml_load_string($response);

        if($data->TransactionOpenResponse->TransactionItem->StatusCode == 1) {
            $url = $data->TransactionOpenResponse->TransactionItem->DownloadURL;
            $transactionId = $data->TransactionOpenResponse->TransactionItem->TransactionId;
            $sale->assets()->updateExistingPivot($this->id, ['url' => $url, 'transaction_id' => $transactionId]);

            return true;
        }

        return false;

    }
}
