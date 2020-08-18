<?php

namespace Shenheishe\Assist\Src\Console;

use Illuminate\Console\Command;

class TableToLocaleFileCommand extends Command
{
    protected $signature = 'dk:locale';

    protected $description = '通过数据表生成数据字典文件';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //创建字典目录
        $this->createDir();
        $tableColumns = $this->tableColumns();
        foreach ($tableColumns as $table => $columns) {
            $contents = "<?php \n";
            $contents .= "return [ \n";
            foreach ($columns as $column) {
                $contents .= "    '{$column->col}'=>'{$column->comment}', \n";
            }
            $contents .= '];';
            //生成字典文件
            $this->laravel['files']->put(resource_path("lang/zh-CN/dictionary/{$table}.php"), $contents);
        }
    }


    /**
     * 创建目录
     */
    protected function createDir()
    {
        $path = resource_path('lang/zh-CN/dictionary');
        \File::isDirectory($path) or \File::makeDirectory($path,0755,true,true);
    }

    /**
     * 获取数据库中所有表及表字段信息
     * @return array
     */
    protected function tableColumns(): array
    {
        $tables = \DB::select('select table_name from information_schema.tables where table_schema=? and table_type="base table"', [env('DB_DATABASE')]);
        $arr = [];
        foreach ($tables as $table) {
            $arr[$table->table_name] = $this->columns($table->table_name);
        }
        return $arr;
    }

    /**
     * 获取指定表字段信息.
     * @param string $table
     * @return mixed
     */
    protected function columns(string $table)
    {
        return \DB::select('SELECT column_name as col,column_comment as comment FROM information_schema.COLUMNS WHERE table_name = ? AND table_schema = ?', [$table, env('DB_DATABASE')]);
    }
}