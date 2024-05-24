<?php

namespace App\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use CodeIgniter\Database\Migration;

class Init extends Migration
{
    public function up()
    {
        Capsule::schema()->create('tb_kriteria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode');
            $table->string('nama');
            $table->integer('bobot');
            $table->timestamps();
        });

        Capsule::schema()->create('tb_sub_kriteria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kriteria_id');
            $table->string('nama');
            $table->integer('bobot');
            $table->timestamps();
        });

        Capsule::schema()->create('tb_alternatif', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nip');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('bidang_tugas');
            $table->timestamps();
        });

        Capsule::schema()->create('tb_penilaian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alternatif_id')->unsigned();
            $table->json('sub_kriteria_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('tb_kriteria');
        Capsule::schema()->dropIfExists('tb_sub_kriteria');
        Capsule::schema()->dropIfExists('tb_alternatif');
        Capsule::schema()->dropIfExists('tb_penilaian');
    }
}
