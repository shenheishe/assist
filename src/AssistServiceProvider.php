<?php


namespace Shenheishe\Assist;


use Illuminate\Support\ServiceProvider;

class AssistServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        //发布配置文件
        $this->publishes([__DIR__ . '/../config/assist.php' => config_path('assist.php'),]);
        $this->publishes([__DIR__.'/../resources/assets' => public_path('vendor/assist')], 'assist-assets');
        //扩展包视图
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'assist');
    }

    public function provides()
    {
        return [
            ErrorReport::class,
        ];
    }
}