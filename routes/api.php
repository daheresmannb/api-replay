<?php

use Illuminate\Http\Request;

Route::post("/replay/crear","ReplayController@CrearReplay");
Route::post("/replay/obtener","ReplayController@ObtenerReplay");
Route::post("/replay/usuario/obtener","ReplayController@ObtenerReplayByUser");
Route::post("/replay/eliminar","ReplayController@EliminarReplay");