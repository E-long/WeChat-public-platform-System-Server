<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Users extends Migrator
{
    public function up()
        {
            // create the table
            $table = $this->table('users');
            $table->addColumn('user', 'string',['comment'=>'用户名'])
                ->addColumn('real_name', 'string',['comment'=>'用户真实姓名'])
                ->addColumn('email', 'string',['comment'=>'邮箱'])
                ->addColumn('password', 'string',['comment'=>'密码'])
                ->addColumn('avatar', 'string', ['null' => true, 'default'=>NULL, 'comment'=>'用户头像'])
                ->addColumn('motto', 'string',['comment'=>'座右铭'])
                ->addColumn('phone', 'string',['comment'=>'电话号'])
                ->addColumn('sex', 'boolean',['default'=>0, 'comment'=>'用户性别'])
                ->addColumn('language', 'string',['comment'=>'用户语言设置'])
                ->addColumn('user_type', 'string',['comment'=>'用户类型'])
                ->addColumn('last_login_ip', 'string',['comment'=>'最后登录ip'])
                ->addColumn('last_login_time', 'string',['default'=>NULL,'comment'=>'最后登录时间'])
                ->addTimestamps()
                ->addIndex('user', ['unique' => true])
                ->addIndex('email', ['unique' => true])
                ->create();


        }
        /**
         * Migrate Down.
         */
        public function down()
        {
            $this->dropTable('users');
        }
}
