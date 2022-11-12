<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertSampleDataUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            [
                'username' => 'teacher1',
                'password' => bcrypt('123456a@A'),
                'name' => 'Teacher1',
                'email' => 'teacher1@gmail.com',
                'phone_number' => 99998,
                'level' => 1,
            ],
            [
                'username' => 'student1',
                'password' => bcrypt('123456a@A'),
                'name' => 'Student1',
                'email' => 'student1@gmail.com',
                'phone_number' => 99777,
                'level' => 0,
            ],
        ];
        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}