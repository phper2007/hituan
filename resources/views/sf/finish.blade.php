@extends('layouts.index')

@section('content')

        <div class="page-header">
            <h1>最终数据</h1>
        </div>
        <div class="well">
            @foreach($address as $key => $item)
                <p>{{$item}}。{{$nowProduct[$product[$key]]}}。{{$count[$key]}}</p>
            @endforeach
            </form>
        </div>
@endsection


