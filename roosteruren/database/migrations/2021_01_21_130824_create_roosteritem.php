<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoosteritem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		DB::statement("
			CREATE TABLE IF NOT EXISTS `roosteritem` (
				`id` bigint(20) unsigned NOT NULL,
				`date` int(10) unsigned NOT NULL,
				`afdeling` smallint(5) unsigned NOT NULL,
				`user` int(10) unsigned NOT NULL,
				`data` longblob NOT NULL,
				PRIMARY KEY (`id`)
		   	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
		");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roosteritem');
    }
}
