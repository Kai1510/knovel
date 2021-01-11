<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CkeditorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Http\Controllers\BookController;
use App\Http\Controllers\VolController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ReadController;


Route::get('/', function () {
    return redirect()->route('books.index');
})->name('welcome');

Route::get('logout', function ()
{
	auth()->logout();
	Session()->flush();

	return Redirect::to('/');
})->name('logout');


Route::post('/ckeditor/image_upload', [CkeditorController::class, 'upload'])->name('upload');

Route::get('/series', function() {
	return view('seri');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Redirect::to('/books');
})->name('dashboard');


Route::resource('/books', BookController::class);

Route::resource('/book/{book_id}/vol', VolController::class, [
	'names'=> [
		'store'=>'vol.new',
		'create'=>'vol.add',
		'edit'=>'vol.edit',
		'update'=>'vol.update',
		'delete'=>'vol.destroy'
	]
]);

Route::resource('/book/{book_id}/vol/{vol_id}/chapter', ChapterController::class, [
	'names'=> [
		'store'=>'chapter.new',
		'create'=>'chapter.add',
		'edit'=>'chapter.edit',
		'update'=>'chapter.update',
		'delete'=>'chapter.destroy'
	]
]);

Route::get('book/{id}', function($id) {
	$b = Book::query()->findOrFail($id);
    return view('book.info', ['b'=>$b]);
})->name('info');

Route::get('/read/{book_id}/vol/{vol_id}/chapter/{chapter_id}', [ReadController::class, 'read'])->name('read');

Route::get('/user/truyendadang', [ReadController::class, 'truyendadang'])->name('truyendadang');