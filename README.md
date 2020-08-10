<h1 align="center"> assist </h1>

<p align="center"> Laravel Developer Assistant.</p>


## Installing

```shell
$ composer require shenheishe/assist -vvv
```

## 运行下面的命令来发布资源

```shell
php artisan vendor:publish --provider="Shenheishe\Assist\AssistServiceProvider" --force
```

## laravel 异常邮箱提醒

- 配置laravel的邮件发送功能
- 在 /app/Exceptions/Handler.php 中配置一行代码
- 在 assist.php 中设置异常接收邮箱

```php
public function render($request, Exception $exception)
{
   app(ErrorReport::class)->send($request,$exception);
   return parent::render($request, $exception);
}
```

## License

MIT