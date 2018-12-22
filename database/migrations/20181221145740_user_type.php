<?php

use think\migration\Migrator;
use think\migration\db\Column;

class UserType extends Migrator
{
    public function up()
        {
            // create the table
            $table = $this->table('user_type');
            $table->addColumn('user_type', 'string',['comment'=>'用户类型'])
                ->addColumn('name', 'string',['comment'=>'类型名称'])
                ->addColumn('power', 'string',['comment'=>'类型权限'])
                ->addTimestamps()
                ->create();
        }
        /**
         * Migrate Down.
         */
        public function down()
        {
            $this->dropTable('user_type');
        }
}
