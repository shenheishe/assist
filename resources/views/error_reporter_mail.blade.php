<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<style>
    * {
        font-size: 13px;
    }

    body {
        padding: 10px;
    }

    table {
        width: 100%;
    }

    table th {
        text-align: left
    }

    table th, table td {
        padding: 5px;
    }

    table tr:nth-of-type(odd) {
        background-color: #f9f9f9
    }

    h4 {
        margin-top: 10px;
        margin-bottom: 5px;
        font-size: 16px
    }
</style>
<body>
<div class="container">
    <h4 class="h4">请求地址<br><small>{!! $url !!}</small></h4>
    <h4 class="h4">请求方式<br><small>{!! $method !!}</small></h4>
    <div class="input">
        <h4 class="h4">请求参数</h4>
        <table>
            @if(is_array($input))
                @foreach($input as $key=>$val)
                    <tr>
                        <th>{{$key}}:</th>
                        <td style="word-break: break-all">{{$val}}</td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
    <div class="header">
        <h4>请求头信息</h4>
        <table>
            @foreach($header as $key=>$val)
                <tr>
                    <th>{{$key}}:</th>
                    <td style="word-break: break-all">{{$val[0]}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="content">
        <h4>异常内容</h4>
        <p style="word-break: break-all">{!! $content !!}</p>
    </div>
</div>
</body>
</html>
