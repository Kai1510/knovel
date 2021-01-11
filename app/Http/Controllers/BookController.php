<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bs = Book::with('user')->with('genres')->with('vols')->paginate(10);
        return view('book.index', ['bs'=>$bs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'img' => 'required',
            'summary' => 'required',
        ]);
        $img = "";
        if($request->hasFile('img')) {
            $file = $request->img;
            $file->move(public_path('upload'), $file->getClientOriginalName());
            $img = 'upload/'.$file->getClientOriginalName();  

        }
        $b = new Book();
        $b->user_id = Auth::user()->id;
        $b->title = $request->title;
        $b->author = $request->author;
        $b->img = $img;
        $b->artist= $request->artist;
        $b->type = $request->type;
        $b->summary = $request->summary;
        $b->save();
        $b->genres()->attach($request->genres);
        return redirect()->route('books.index')->with('status','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $b = Book::query()->findOrFail($id);
        return view('book.edit', ['b'=>$b]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'img' => 'required',
            'summary' => 'required',
        ]);
        $b = Book::query()->findOrFail($id);
        $img = $b->img;
        if($request->hasFile('img')) {
            $file = $request->img;
            $file->move(public_path('upload'), $file->getClientOriginalName());
            $img = 'upload/'.$file->getClientOriginalName();  

        }
        $b->title = $request->title;
        $b->author = $request->author;
        $b->img = $img;
        $b->artist= $request->artist;
        $b->type = $request->type;
        $b->summary = $request->summary;
        $b->save();
        $b->genres()->detach();
        $b->genres()->attach($request->genres);
        return redirect()->route('info', $b->id)->with('status','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $b = Book::destroy($id);
        return redirect()->route('books.index')
        ->with('status','Xóa thành công');
    }
}
