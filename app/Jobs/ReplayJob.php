<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Replay;

class ReplayJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $replay_unity;
    protected $replay_ui;

    public function __construct($replay_unity, $replay_ui) {
        $this->replay_unity = $replay_unity;
        $this->replay_ui    = $replay_ui;
    }

    public function handle() {
        $replay = new Replay();
        $replay->replay_unity = base64_decode($this->replay_unity);
        $replay->replay_ui    = base64_decode($this->replay_ui);
        $replay->save();
    }
}