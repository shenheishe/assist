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

class TableToColumnCommand extends Command
{
    protected $signature = 'dk:col {table} {--type=}';

    protected $description = '通过数据表生成指定字段样式';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = $this->argument('table');
        $type = $this->options('type')['type'];

        if (!\Schema::hasTable($table)) {
            $this->error("{$table} 表名不存在");

            return;
        }
        $columns = \DB::select('SELECT column_name as col,column_comment as comment FROM information_schema.COLUMNS WHERE table_name = ? AND table_schema = ?', [$table, env('DB_DATABASE')]);
        $str = '';
        foreach ($columns as $column) {
            switch ($type) {
                case 'str':
                    $str .= "'{$column->col}',\n";
                    break;
                case 'array':
                    $str .= "'{$column->col}'=>'',\n";
                    break;
                case 'comment':
                    $str .= "'{$column->col}'=>'{$column->comment}',\n";
                    break;
                case 'resource':
                    $str .= "'{$column->col}'=> \$this->{$column->col},\n";
                    break;
                default:
                    $str .= "'{$column->col}',";
            }
        }
        $this->info($str);
    }
}
