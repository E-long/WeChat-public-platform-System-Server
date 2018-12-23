<?php

use think\migration\Seeder;

class UserTypeSeeds extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {

        $data=[
            'user_level'=>0,
            'name'=>'超级管理员',
            'power'=>'{}'
        ];
        db('user_type')->insert($data);
    }
}