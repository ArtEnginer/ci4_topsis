<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Database\Migration;
use App\Libraries\DB;

class Init extends Migration
{
    public function up()
    {
        DB::schema()->create('tb_kriteria', function ($table) {
            $table->increments('id');
            $table->string('kode');
            $table->string('nama');
            $table->integer('bobot');
            $table->timestamps();
        });

        DB::schema()->create('tb_sub_kriteria', function ($table) {
            $table->increments('id');
            $table->integer('kriteria_id');
            $table->string('nama');
            $table->integer('bobot');
            $table->timestamps();
        });

        DB::schema()->create('tb_alternatif', function ($table) {
            $table->increments('id');
            $table->string('nama');
            $table->timestamps();
        });

        DB::schema()->create('tb_nilai', function ($table) {
            $table->increments('id');
            $table->integer('alternatif_id');
            $table->integer('kriteria_id');
            $table->integer('sub_kriteria_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        DB::schema()->dropIfExists('tb_kriteria');
        DB::schema()->dropIfExists('tb_sub_kriteria');
        DB::schema()->dropIfExists('tb_alternatif');
        DB::schema()->dropIfExists('tb_nilai');
    }
}
