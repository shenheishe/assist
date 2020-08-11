@component('mail::message')

<h3 style="background-color: #990000;color: white; padding: 8px;word-break: break-all">{{$message?:"无"}}</h3>

## {{$method}} <span>{{$url}}</span>

@if(is_array($input) && count($input))
<br>

## 请求参数:
@component('mail::table')
| 参数        | 值         |
| :--------- | :--------- |
@foreach($input as $key=>$val)
|  {{$key}}      | {{$val}}     |
@endforeach
@endcomponent
@endif

<br>

## UserAgent:
{{$user_agent}}

<br>

## 错误详情:
<div style="word-break: break-all">{{$content}}</div>

@endcomponent
