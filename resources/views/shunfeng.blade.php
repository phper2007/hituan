<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if($errors)
                <span style="color: red">
                {{implode('<br />', $errors)}}
                </span>
                <br />
                <br />
                <br />
                <br />
            @endif
            @if($data)
            {{$data['personalName']}} {{$data['telephone']}}<br />
            {{$data['province']}} {{$data['city']}} {{$data['area']}} {{$data['site']}}<br />
            @endif
            <br />
            <br />
            <br />
            <form method="post" action="">
                {{csrf_field()}}
                <textarea name="address" rows="10" cols="60">{{$address}}</textarea>
                <br />
                <input type="submit" value="查询">
            </form>
        </div>
        <br />
        <br />
        <br />
        {{$content}}
    </body>
</html>
