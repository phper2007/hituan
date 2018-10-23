<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $todayProductFile = 'product/today.txt';

    public function analysis(Request $request)
    {
        $nowProduct = '';
        if(Storage::exists($this->todayProductFile))
        {
            $nowProduct = Storage::get($this->todayProductFile);
        }

        $content = $request->input('content');

        $data = [];
        $groupDate = '';

        if($request->isMethod('post'))
        {
            $arr = array_filter(array_map('trim', explode("\r\n", $content)));

            $num = 1;
            foreach ($arr as $val)
            {
                $matches = [];

                if(!$groupDate && preg_match("/([0-9]{1,2})\.([0-9]{1,2}).*/", $val, $matches))
                {
                    $groupDate = mktime(0, 0, 0, $matches[2], $matches[1], date('Y'));
                }
                elseif ($groupDate && preg_match("/{$num}\.(.*)/", $val, $matches))
                {
                    $data[$num] = $matches[1];
                    $num++;
                }
            }
            /*print_r($arr);
            print_r($data);*/
        }

        return view('product.analysis', compact('content', 'data', 'groupDate', 'nowProduct'));
    }

    public function save(Request $request)
    {
        $groupDate = $request->post('groupDate');
        $content = $request->post('content');

        Storage::put("product/{$groupDate}.txt", $content);
        Storage::put($this->todayProductFile, $content);

        return redirect()->route('sf.standard')->with('success', '产品更新成功');
    }
}
