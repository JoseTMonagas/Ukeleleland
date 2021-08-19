<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LimitController extends Controller
{
    public function show()
    {
        return view('info_limite');
    }

    public function liberarWebpay()
    {
        $configuration = new \Transbank\Webpay\Configuration();
        $configuration->setEnvironment('PRODUCCION');
        $configuration->setCommerceCode('597035226141');
        $configuration->setPublicCert('-----BEGIN CERTIFICATE-----
MIIDOTCCAiECFBdD3k4S40CFHeL7FthaWwVPIIfbMA0GCSqGSIb3DQEBCwUAMFkx
CzAJBgNVBAYTAlhYMRUwEwYDVQQHDAxEZWZhdWx0IENpdHkxHDAaBgNVBAoME0Rl
ZmF1bHQgQ29tcGFueSBMdGQxFTATBgNVBAMMDDU5NzAzNTIyNjE0MTAeFw0yMDAy
MTMxMjUyMjdaFw0yNDAyMTIxMjUyMjdaMFkxCzAJBgNVBAYTAlhYMRUwEwYDVQQH
DAxEZWZhdWx0IENpdHkxHDAaBgNVBAoME0RlZmF1bHQgQ29tcGFueSBMdGQxFTAT
BgNVBAMMDDU5NzAzNTIyNjE0MTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoC
ggEBAMPfGithnN/RzdF3cVo3eAQHluRexm8sAGjakrMn6dJujLxxoSn+Lb0h1d1D
F4ZCLG9QnmJzQ3oZff85yFYj8OHHBAVuWHQK/5400DsWdDefvx5kcI1bj5XUtfCe
fxJGv+YKW54nZNCw1AR1sZm5q/93p0XTODj0UMdemXlF6A5OCI4+GPy6KqDzSlIl
SeN73BweRc24vRslqU+mZcdfSFQ0iW1FPclHIelvYijPe8P/SxvntEiuDkgX0aJH
okdE01HVH8B8x8kIKBoufYd+mVyy4DwGS3HBaO4Ax/MhLXc5DXVnQthfwZrAtcA+
GzaDYHwCe/wEbUoOB/GMhoBuEvMCAwEAATANBgkqhkiG9w0BAQsFAAOCAQEAPKty
eP7vyxxNPcsi5qfl8iQ6m2OdFSHmgFc5oEu//2SQ3oPodTDj1SBLlyjTIcQz21Rq
RzTeIP9tO8GVfBxjPqErZhoYkPVtFcu5g3NkWBFRrCTyRb5r5v3pThCcn7N7INwX
wnARHkUBeCvyTlpLYZ69EXpi8kgcoJpwRJXUR+UcgHYgPvBgXMx8CDGJAhED0/hB
pkfyQJXaqKLi9HmmQr/w62BTaNUaBggpCATK1zbiHJ0rG28azCLMpTE5LdrCIAxg
NfQbtCg0M0NEunD/K5G9G+54p6++NqAssScjuk4o8yvUFI8U74XBSlFq5HdXMbdb
kBJgzP5gN+hz5P3yEQ==
-----END CERTIFICATE-----
');
        $configuration->setPrivateKey('-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAw98aK2Gc39HN0XdxWjd4BAeW5F7GbywAaNqSsyfp0m6MvHGh
Kf4tvSHV3UMXhkIsb1CeYnNDehl9/znIViPw4ccEBW5YdAr/njTQOxZ0N5+/HmRw
jVuPldS18J5/Eka/5gpbnidk0LDUBHWxmbmr/3enRdM4OPRQx16ZeUXoDk4Ijj4Y
/LoqoPNKUiVJ43vcHB5Fzbi9GyWpT6Zlx19IVDSJbUU9yUch6W9iKM97w/9LG+e0
SK4OSBfRokeiR0TTUdUfwHzHyQgoGi59h36ZXLLgPAZLccFo7gDH8yEtdzkNdWdC
2F/BmsC1wD4bNoNgfAJ7/ARtSg4H8YyGgG4S8wIDAQABAoIBABzeNeIs6c0HA/ma
TAeK41Jct/2ChmZ+KrVJeZOUD18nUfC4IpOo1Z7pbLbGm6H7AMeLLzy9VjWZqjtC
jec8NtVf2pTeVYUM1e3AROxge9Jy5d0Z2ojK9NeVWRdUlM/hw4ipACXIEpC7bxQV
MI7Ckbn+LZYZ8lBamck4hRAdoHzy+zr9uMBr8NJAqu9M9WK+UmrUdtUclatMPMeG
gu1qxPPt3kfBsbr+PwKFyzmHWqYOJa7r9k1A6qEYscIhUn05Ia1wDVQf/9rOzBsp
9SvG0asp7IOQVbNxIvgKDk6UafurE3e2DAshplKP+S3chwxVCxucexp12snYy0gB
Cx9lq1kCgYEA6O3VsmBw5my2cE6Onj+WIgntg9dEsxyyFg9K+cBIS1SHNrEPP/Ry
3ayJEJEL8vbZN8PRf9WGrYQ0Dsc0o/+ONDQJSNF0QhPgU3rHVgSpBvZqLGlI3oWd
V2x8GYG5zC1czgpmGSzzY/8DqjSqRYKjQyL7dzQcnZzY5fq0iZ8Agk8CgYEA10Wi
Nl6sTfqUOse4Jy6nA79eieRXE4MNZq2mp3pBuqQqC17WuVqYJ+lWpf+yP8ySMP//
YROTTfJ5ibEXDvaK1wY3DbZcCUcKpvUq4DkTE0myfNCfp5uS3qrB7CdHuDf+x075
9dLQ6LHO6l3rU35IShGcUnBCNYMT3fX8qmpnsB0CgYA2+OKFPaOHjkKkULXx/RnG
oMcwZV6uUuhosmVEei/Vr3ZV3wW1V1DAplaW1VSXm9B6C7nmzJMDYn8SucrfpZF/
GoTSbbRdX+mCaiifUWw+22sFXje3ZJtUpaLINkiOOmp7qhKcgHJUuDu6MMG6s/Eq
CBiG8oKKZBkAdeGj1SW+mwKBgCcNYdT9LcLjr1pOevDYvMGoSM05GDbY8mhrHi2J
tzzVpS704H01mx66bNamYT7DrM2o0zpYI8PjNfstniI/xYYmgXxCVcX1FlCdb07H
69b26qNL8XqldWphjdZ6db9MoTKk+CGJQg7EmuXXbeZypUiSk0o9RTWR9tuwUUrV
DMRdAoGBAKEb0PSvzN/sb77NdAUpHhIE7PXi0csDRC+un5sOALN240+F7pQCqu5w
0ORbrcnqRMtSUTg2gfUUGXCBKPD4q/8fATpvN07cPdfdOVSV2bw6kAI+418ZMr/8
S0/A82BlTwLg+pqs//jxSkxEcyfQ7uLIUvT5Bg/OU1LDvPl9UJmB
-----END RSA PRIVATE KEY-----
');

        $transaction = (new Webpay($configuration))
            ->getNormalTransaction();

        $discount = 0;
        $amount = 1000;

        $sale = \App\Sale::create([
            'sesion' => (\Carbon\Carbon::now()->timestamp),
            'total' => $amount,
            'descuento' => $discount,
            'profile' => \Auth::user()->profile,
            'mensaje' => "SIN LIMITE",
            'tipo_pago' => 'webpay'
        ]);

        if (\Auth::user()) {
            $sale->users()->attach(\Auth::user()->id);
        }

        // Identificador que será retornado en el callback de resultado:
        $sessionId = $sale->sesion;
        // Identificador único de orden de compra:
        $buyOrder = $sale->id;
        $returnUrl = route('webpay.voucher');
        $finalUrl = route('webpay.finish');
        $initResult = $transaction->initTransaction(
            $amount, $buyOrder, $sessionId, $returnUrl, $finalUrl);
        $formAction = $initResult->url;
        $tokenWs = $initResult->token;
        \Session::put('premium', true);
        return redirect()->route('webpay.token')->with(compact('formAction', 'tokenWs'));
    }

    public function liberarTransferencia()
    {
        $discount = 0;
        $amount = 1000;

        $sale = \App\Sale::create([
            'sesion' => (\Carbon\Carbon::now()->timestamp),
            'total' => $amount,
            'descuento' => $discount,
            'profile' => \Auth::user()->profile,
            'tipo_pago' => 'transferencia'
        ]);

        if (\Auth::user()) {
            $sale->users()->attach(\Auth::user()->id);
        }

        $msg = [
            "status" => "OK",
            "msg" => "Venta Creada"
        ];

        return response()->json($msg);
    }
}
