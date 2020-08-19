<?php

/*
 * This file is part of the shenheishe/assist.
 *
 * (c) shenheishe <shenheishe@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Shenheishe\Assist;

use Illuminate\Support\ServiceProvider;
use Shenheishe\Assist\Src\Console\TableToColumnCommand;
use Shenheishe\Assist\Src\Console\TableToLocaleFileCommand;
use Shenheishe\Assist\Src\Console\TableToSeedCommand;

class AssistServiceProvider extends ServiceProvider
{
    protected $defer = true;

    protected $commands = [
        TableToColumnCommand::class,
        TableToLocaleFileCommand::class,
        TableToSeedCommand::class,
    ];

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/assist.php', 'assist');
        $this->commands($this->commands);
    }

    public function boot()
    {
        //发布配置文件
        $this->publishes([__DIR__ . '/../config/assist.php' => config_path('assist.php')]);
        $this->publishes([__DIR__ . '/../resources/assets' => public_path('vendor/assist')], 'assist-assets');
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
