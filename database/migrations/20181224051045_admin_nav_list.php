<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AdminNavList extends Migrator
{
    public function up()
    {
        // create the table
        $table = $this->table('admin_nav_list');
        $table->addColumn('user_level', 'string',['comment'=>'用户级别'])
            ->addColumn('name', 'string',['comment'=>'类型名称'])
            ->addColumn('url', 'string',['comment'=>'地址'])
            ->addColumn('fid', 'string',['comment'=>'父级导航'])
            ->addColumn('sid', 'string',['comment'=>'子级导航'])
            ->addColumn('user', 'string',['comment'=>'创建人'])
            ->addTimestamps()
            ->create();
    }
    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('admin_nav_list');
    }
}
