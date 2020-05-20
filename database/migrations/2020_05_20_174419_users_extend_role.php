<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersExtendRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', static function (Blueprint $table) {
            $table->integer('role')->default(3);
        });
        $role_users = DB::table('role_user')->select('user_id', 'role_id')->get();
        foreach ($role_users as $role_user) {
            DB::table('users')->where('id', $role_user->user_id)->update(['role' => $role_user->role_id]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $role_users = DB::table('users')->select('id', 'role')->get();
        foreach ($role_users as $role_user) {
            DB::table('role_user')->where('user_id', $role_user->id)->updateOrInsert(['role_id' => $role_user->role]);
        }
        Schema::table('users', static function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
}
