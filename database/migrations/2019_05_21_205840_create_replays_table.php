<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplaysTable extends Migration {
    public function up() {
        Schema::create(
            'vjs_replay', 
            function (Blueprint $table) {
                $table->bigIncrements('replay_id');
                $table->binary('replay_unity');
                $table->binary('replay_ui');
                $table->integer('user_id');
                $table->foreign('user_id')
                    ->references('user_id')
                ->on('vjs_user');
                $table->timestamps();
            }
        );
        DB::statement("ALTER TABLE vjs_replay modify replay_unity MEDIUMBLOB");
        DB::statement("ALTER TABLE vjs_replay modify replay_ui MEDIUMBLOB"); 
    }

    public function down() {
        Schema::dropIfExists('vjs_replay');
    }
}