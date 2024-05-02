<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\AuthContoller;
use App\Http\Controllers\Api\EventController;
use App\Http\Resources\AuthResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get("/user", function (Request $request) {

    return $request->user();
});
Route::post("/login", [AuthContoller::class, "login"])->name("user.login");
Route::apiResource("events", EventController::class);
Route::apiResource('events.attendees', AttendeeController::class)->scoped();
Route::fallback(function () {
    // return redirect()->route('events.index');
    return response(status: 400, content: '{message:"bad request"}');
});
