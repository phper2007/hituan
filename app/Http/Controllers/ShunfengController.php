<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ShunfengController extends Controller
{
    public function index(Request $request)
    {
        $address = $request->input('address');
        $content = '';
        $errors = [];

        if($request->method('post'))
        {
            $url = "http://ucmp.sf-express.com/cx-wechat-order/order/address/intelAddressResolution?address=";
            $url .= urlencode($address);

            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', $url);
            $content = $res->getBody();

            $data = json_decode($content, true);
            $data = $data['obj'];

            if(!$data['province'])
            {
                $errors[] = '省份错误';
            }
            if(!$data['city'])
            {
                $errors[] = '城市错误';
            }
            if(!$data['area'])
            {
                $errors[] = '区、县错误';
            }
            if(!$data['site'])
            {
                $errors[] = '无详细地址';
            }
        }

        return view('shunfeng', compact('address', 'content', 'errors', 'data'));
    }
}
