<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserDayIndexAfdeling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
			CREATE TABLE IF NOT EXISTS `user_day_index_afdeling` (
				`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`userday` bigint(20) unsigned NOT NULL,
				`afdeling` smallint(5) unsigned NOT NULL,
				PRIMARY KEY (`id`)
		   	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4
		");
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
