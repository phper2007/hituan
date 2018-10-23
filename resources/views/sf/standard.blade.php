@extends('layouts.index')

@section('content')
    @if($errors)
        <div class="alert alert-danger" role="alert">
            {{implode('<br />', $errors)}}
        </div>
    @endif


    @if($data)
        <div class="page-header">
            <h1>解析后数据</h1>
        </div>
        <div class="well">
            <form method="post" action="{{route('sf.finish')}}" target="_blank">
                {{csrf_field()}}
            @foreach($data as $key => $address)
                    <div class="row">
                        <div class="col-md-7"><textarea name="address[{{$key}}]" class="form-control" rows="3">{{$address['personalName']}}。{{$address['telephone']}}。{{$address['province']}}{{$address['city']}}{{$address['area']}}{{$address['site']}}</textarea></div>
                        <div class="col-md-3">{!! form_option($nowProduct, false, "product[$key]", '选择产品', ' class="form-control"') !!}</div>
                        <div class="col-md-2"><input type="input" class="form-control" name="count[{{$key}}]" placeholder="数量" value="1"></div>
                    </div>
            @endforeach

                <button type="submit" class="btn btn-default">生成</button>
            </form>
        </div>
    @endif

    <div class="row">
        <h1>地址信息</h1>

        <form method="post" action="">
            {{csrf_field()}}
        <textarea name="content" class="form-control" rows="10">{{$content}}</textarea>

        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    </div>
    @if($responseContent)
    <div class="row">
    <pre>{{htmlspecialchars($responseContent)}}</pre>
    </div>
    @endif
@endsection


