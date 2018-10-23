<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class SfController extends Controller
{
    protected $todayProductFile = 'product/today.txt';

    public function standard(Request $request)
    {
        $nowProduct = [];
        if(Storage::exists($this->todayProductFile))
        {
            $nowProduct = Storage::get($this->todayProductFile);
            $nowProduct = explode("\r\n", $nowProduct);
        }

        $content = $request->input('content');
        $responseContent = '';
        $errors = [];
        $data = [];

        if($request->isMethod('post'))
        {
            $url = "http://ucmp.sf-express.com/cx-wechat-order/order/address/intelAddressResolution?address=";

            $client = new \GuzzleHttp\Client();

            $arr = explode('@@', $content);

            foreach ($arr as $address)
            {
                $res = $client->request('POST', $url . urlencode($address));
                $responseContent = $res->getBody();

                $sfArr = json_decode($responseContent, true);
                $sfArr = $sfArr['obj'];

                $error = [];
                if(!$sfArr['personalName'])
                {
                    $error[] = '无姓名';
                }
                if(!$sfArr['telephone'])
                {
                    $error[] = '无电话';
                }
                if(!$sfArr['province'])
                {
                    $error[] = '省份错误';
                }
                if(!$sfArr['city'])
                {
                    $error[] = '城市错误';
                }
                if(!$sfArr['area'])
                {
                    $error[] = '区、县错误';
                }
                if(!$sfArr['site'])
                {
                    $error[] = '无详细地址';
                }

                if($error)
                {
                    $errors[] = $address . ':' . implode('、', $error);
                }
                $data[] = $sfArr;
            }
        }

        return view('sf.standard', compact('nowProduct', 'responseContent', 'content', 'errors', 'data'));
    }

    public function finish(Request $request)
    {
        $nowProduct = [];
        if(Storage::exists($this->todayProductFile))
        {
            $nowProduct = Storage::get($this->todayProductFile);
            $nowProduct = explode("\r\n", $nowProduct);
        }

        $address = $request->post('address');
        $product = $request->post('product');
        $count = $request->post('count');

        return view('sf.finish', compact('address', 'product', 'count', 'nowProduct'));
    }
}
