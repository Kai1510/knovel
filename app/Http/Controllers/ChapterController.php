<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Book;
use App\Models\Vol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($book_id, $vol_id)
    {
        $b = Book::query()->findOrFail($book_id);
        $v = Vol::query()->findOrFail($vol_id);
        return view('chapter.create', ['v'=>$v]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $book_id, $vol_id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $c = new Chapter();
        $c->title = $request->title;
        $c->content = $request->content;
        $c->vol_id = $vol_id;
        $c->save();
        return redirect()->route('info', ['id'=>$book_id])->with('status','Thêm chương mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit($book_id, $vol_id, $chapter_id)
    {
        $c = Chapter::query()->findOrFail($chapter_id);
        return view('chapter.edit', ['c'=>$c]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $book_id, $vol_id, $chapter_id)
    {
        $c = Chapter::query()->findOrFail($chapter_id);
        $c->title = $request->title;
        $c->content = $request->content;
        $c->save();
        return redirect()->route('info', $book_id)->with('status','Sửa chương thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy($book_id, $vol_id, $chapter_id)
    {
        $c = Chapter::query()->findOrFail($chapter_id);
        $c->delete();
        return redirect()->route('info', ['id'=>$book_id])->with('status','Xóa chương thành công');
    }
}
