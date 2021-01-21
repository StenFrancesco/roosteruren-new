<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerlof extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		DB::statement("
			CREATE TABLE IF NOT EXISTS `verlof` (
				`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`user` int(10) unsigned NOT NULL,
				`from` int(10) unsigned NOT NULL,
				`to` int(10) unsigned NOT NULL,
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
        Schema::dropIfExists('verlof');
    }
}
