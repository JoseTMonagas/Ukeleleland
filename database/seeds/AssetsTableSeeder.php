<?php

use Illuminate\Database\Seeder;

class AssetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $damResponse = new \SimpleXMLElement(file_get_contents(storage_path('app/xml/DAMResponse.xml')));

        foreach ($damResponse->Classification->CategoryName as $Category) {
            $category = new \App\Category;
            $category->id = $Category['catId'];
            $category->name = $Category;
            $category->slug = str_replace(' ', '-', strtolower($Category));
            if (!$category->saveOrFail()) {
                dd($category);
            }
        }

        foreach ($damResponse->ContributorRoles->ContributorRole as $role) {
            $contributorRole = new  \App\ContributorRole;
            $contributorRole->id = $role['roleId'];
            $contributorRole->name = $role;
            if (!$contributorRole->saveOrFail()) {
                dd($contributorRole);
            }
        }

        foreach ($damResponse->ImageTypes->ImageType as $type) {
            $imageType = new \App\ImageType;
            $imageType->id = $type['imageTypeId'];
            $imageType->path = $type['imageTypePath'];
            $imageType->name = $type;
            if (!$imageType->saveOrFail()) {
                dd($imageType);
            }
        }

        //TODO: Agregar metadata type: new, update, delete para acciones en base de datos
        foreach ($damResponse->AssetMetadataResponse->AssetMetadata as $AssetMetadata) {
            $asset = new \App\Asset;
            $asset->id = $AssetMetadata->AssetId;
            $asset->format = $AssetMetadata->Format;
            $asset->page_count = $AssetMetadata->PageCount;
            $asset->title = $AssetMetadata->Title;
            $asset->title_sort = $AssetMetadata->TitleSort;
            $asset->song_number = $AssetMetadata->SongNumber;
            $asset->performance_time = $AssetMetadata->PerformanceTime;
            $asset->difficulty_level_low = $AssetMetadata->DifficultyLevelLow;
            $asset->difficulty_level_high = $AssetMetadata->DifficultyLevelHigh;
            $asset->min_qty = $AssetMetadata->MinQty;
            $asset->file_name = $AssetMetadata->FileName;
            $asset->file_source = $AssetMetadata->FileType['fileSource'];
            $asset->file_type = $AssetMetadata->FileType;
            $asset->mime_type = $AssetMetadata->MimeType;
            $asset->file_url = $AssetMetadata->FileURL;
            $asset->public_domain = ($AssetMetadata->SongNumber['public_domain'] == 'true') ? 1 : 0;
            $asset->world_rights = ($AssetMetadata->World == 'true') ? 1 : 0;
            $asset->price = $AssetMetadata->RetailPrice;
            $asset->type = $AssetMetadata->AssetType;
            $asset->description = $AssetMetadata->Description;
            if ($asset->saveOrFail()) {
                foreach ($AssetMetadata->Contributor as $Contributor) {
                    $contributor = new \App\Contributor;
                    $contributor->name = $Contributor->Contributor_Name;
                    $contributor->name_rev = $Contributor->Contributor_Name_Rev;
                    $contributor->name_sort = $Contributor->Contributor_Name_Sort;
                    $contributor->primary = ($Contributor['primary'] == 'true') ? 1 : 0;
                    $contributor->contributor_role_id = $Contributor['roleId'];
                    $asset->contributors()->save($contributor);
                }
                foreach ($AssetMetadata->Category as $Category) {
                    $asset->categories()->attach($Category['catId']);
                }
                foreach ($AssetMetadata->AssetImages->AssetImage as $Image) {
                    $image = new \App\AssetImage; 
                    $image->image_type_id = $Image['imageTypeId'];
                    $image->image = $Image;
                    $asset->images()->save($image);
                }
                foreach ($AssetMetadata->Renderings->Rendering as $Rendering) {
                    $rendering = new \App\Rendering;
                    $rendering->type = $Rendering['renderingType'];
                    $rendering->filename = $Rendering;
                    if ($rendering->saveOrFail()) {
                        $asset->renderings()->attach($rendering->id);
                    }
                }
            }
        }

    }

    /**
     * Returns an array with the asset data
     *
     * @return Array
     */
    private function assetToArray($asset)
    {
        $array = [];
        foreach ($asset as $value) {
            array_push($array, json_decode(json_encode($value), true));
        }
        return $array;
    }
}
