<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replay extends Model {
	protected $table = 'vjs_replay';
    protected $fillable = [
        'replay_id',
        'replay_unity',
        'replay_ui',
        'user_id' 
    ];
}