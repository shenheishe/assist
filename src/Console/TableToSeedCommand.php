<?php

/*
 * This file is part of the shenheishe/assist.
 *
 * (c) shenheishe <shenheishe@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Shenheishe\Assist\Src\Console;

use Illuminate\Console\Command;

class TableToSeedCommand extends Command
{
    protected $signature = 'dk:seed';

    protected $description = '数据表备份';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if ($this->confirm('是否要开始备份所有数据表?')) {
            $tables = \DB::select('SELECT TABLE_NAME FROM information_schema.tables where table_schema=?', [env('DB_DATABASE')]);
            $tableStr = collect($tables)->pluck('TABLE_NAME')->filter(function ($table) {
                return 'migrations' != $table; //排除migrations数据表
            })->join(',');
            $this->call('iseed', [
                'tables'  => $tableStr,
                '--force' => 'default',
            ]);
        }
    }
}
