<h1 align="center"> Assist </h1>

<p align="center"> Laravel Developer Assistant.</p>


## 安装
#### 正常安装
```shell script
$ composer require shenheishe/assist
```

#### 安装最新版本

```shell script
$ composer require shenheishe/assist -vvv
```

#### 更新到开发版
```shell script
$ composer require shenheishe/assist:dev-master -vvv
```

## 运行下面的命令来发布资源

```shell
php artisan vendor:publish --provider="Shenheishe\Assist\AssistServiceProvider" --force
```

## laravel 异常邮箱提醒

- 配置laravel的邮件发送功能
- 在 assist.php 中设置异常接收邮箱

- 在 app/Exceptions/Handler.php 中配置一行代码
```php
public function render($request, Exception $exception)
{
   app(ErrorReport::class)->send($request,$exception);
   return parent::render($request, $exception);
}
```

## 通过数据表生成指定字段数据格式

```shell script
/*
* str id,name
* array ['id'=>'','name'=>'']
* comment ['id'=>'ID'，'name'=>'姓名']
*/

$ php artisan dk:col --type=str
```

## License

MIT