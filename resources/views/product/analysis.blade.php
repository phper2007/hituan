@extends('layouts.index')

@section('content')
    @if($nowProduct)
        <div class="page-header">
            <h1>当前数据</h1>
        </div>
        <div class="well">
            <pre>{{$nowProduct}}</pre>
        </div>
    @endif

    @if($data)
        <h1>{{date('Y年m月d日', $groupDate)}} 解析后数据</h1>

        <form method="post" action="{{route('product.save')}}">
            {{csrf_field()}}
            <input type="hidden" name="groupDate" value="{{$groupDate}}">
            <textarea name="content" class="form-control" rows="10">{{implode("\n", $data)}}</textarea>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    @endif

    <div class="row">
        <h1>接龙信息</h1>

        <form method="post" action="">
            {{csrf_field()}}
        <textarea name="content" class="form-control" rows="10">{{$content}}</textarea>

        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    </div>
@endsection


