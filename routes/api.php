<?php

use App\Http\Controllers\API\BookController;
// use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('storage/{filename}', function ($filename) {
//     $path = storage_path($filename);

//     if (!File::exists($path)) {
//         abort(404);
//     }

//     $file = File::get($path);
//     $type = File::mimeType($path);

//     $response = Response::make($file, 200);
//     $response->header("Content-Type", $type);

//     return "Hello";
// });
Route::post('/books', [BookController::class, 'store']);
Route::get('/books',[BookController::class,'getAll']);
Route::get('/books/{id}', [BookController::class, 'getById']);
Route::delete('/books/{id}', [BookController::class, 'deleteById']);