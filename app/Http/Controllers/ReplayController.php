<?php

namespace App\Http\Controllers;

use App\Replay;
use Illuminate\Http\Request;
use App\Jobs\ReplayJob;
use Validator;
use Lang;

class ReplayController extends Controller {
    public function CrearReplay(Request $request) {
        $val = Validator::make(
            $request->all(), [
                'replay_unity'     => 'required',
                'replay_ui'        => 'required'
            ]
        );
        if ($val->fails()) {
            $respuesta['exito']     = false;
            $respuesta['respuesta'] = $val->messages();
        } else {
            $r_unity = file_get_contents($request->file('replay_unity'));
            $r_ui    = file_get_contents($request->file('replay_ui'));
           
            ReplayJob::dispatch(
                base64_encode($r_unity),
                base64_encode($r_ui)
            );
            $respuesta['exito']     = true;
            $respuesta["respuesta"] = Lang::get("success.success");
        }
        return response()->json($respuesta);
    }

    public function ObtenerReplayByUser(Request $request) {
        $val = Validator::make(
            $request->all(), [
                'user_id'     => 'required'
            ]
        );
        if ($val->fails()) {
            $respuesta['exito']     = false;
            $respuesta['respuesta'] = $val->messages();
        } else {
            $replays = Replay::where(
                'user_id',
                $request->user_id
            )->get();
            $respuesta['exito']     = true;
            $respuesta["data"]      = $replays;
        }
        return response()->json($respuesta);
    }

    public function ObtenerReplay(Request $request) {
        $val = Validator::make(
            $request->all(), [
                'replay_id'     => 'required'
            ]
        );
        if ($val->fails()) {
            $respuesta['exito']     = false;
            $respuesta['respuesta'] = $val->messages();
        } else {
            $replays = Replay::find($request->replay_id);
            $respuesta['exito']     = true;
            $respuesta["data"]      = $replays;
        }
        return response()->json($respuesta);
    }

    public function EliminarReplay(Request $request) {
        $val = Validator::make(
            $request->all(), [
                'replay_id'     => 'required'
            ]
        );
        if ($val->fails()) {
            $respuesta['exito']     = false;
            $respuesta['respuesta'] = $val->messages();
        } else {
            $replays = Replay::find($request->replay_id);
            $replays->delete();
            $respuesta['exito']     = true;
            $respuesta["respuesta"] = Lang::get("success.success");
        }
        return response()->json($respuesta);
    }
}