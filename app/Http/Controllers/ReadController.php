<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chapter;
use App\Models\Book;
class ReadController extends Controller
{
	public function read($book_id, $vol_id, $chapter_id) {
		$c = Chapter::query()->findOrFail($chapter_id);
		$cs = DB::table('chapters')->where('vol_id', $vol_id)->get();
		$cnext_id = 0;
		$cprev_id = 0;
		foreach($cs as $a) {
			if($a->id>$c->id) {
				$cnext_id = $a->id;
				break;
			}
		}
		foreach($cs as $a) {
			if($a->id<$c->id) {
				$cprev_id = $a->id;
			}
		}
		return view('read', ['c'=>$c, 'c1'=>$cprev_id, 'c2'=>$cnext_id]);
	}

	public function truyendadang() {
		$bs = Book::where('user_id', Auth::user()->id)->with('user')->with('genres')->with('vols')->paginate(5);
		return view('truyendadang', ['bs'=>$bs]);
	}
}
