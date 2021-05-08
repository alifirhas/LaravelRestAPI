<?php

use App\Models\Post;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route untuk menampilkan semua post
Route::get('/posts', function () {
    return Post::all();
});

//Route untuk menambahkan post
Route::post('/posts', function () {

    request()->validate([
        'title' => 'required|max:254',
        'content' => 'required',
    ]);

    $succes = Post::create([
        'title' => request('title'),
        'content' => request('content'),
    ]);

    return ["succes" => $succes];

});

Route::put('posts/{post}', function (Post $post) {
    request()->validate([
        'title' => 'required|max:254',
        'content' => 'required',
    ]);

    $succes = $post->update([
        'title' => request('title'),
        'content' => request('content'),
    ]);

    return ["succes" => $succes];
});

Route::delete('posts/{post}', function (Post $post) {
    $succes = $post->delete();

    return ["succes" => $succes];

});