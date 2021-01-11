<?php

namespace App\Http\Controllers;

use App\Models\Vol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VolController extends Controller
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
    public function create($book_id)
    {
       return view('vol.create', ['id'=>$book_id]); 
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $book_id)
    {
        $img = "";
        if($request->hasFile('img')) {
            $file = $request->img;
            $file->move(public_path('upload'), $file->getClientOriginalName());
            $img = 'upload/'.$file->getClientOriginalName();  

        }
        $v = new Vol();
        $v->title = $request->title;
        $v->img = $img;
        $v->book_id = $book_id;
        $v->save();
        return redirect()->route('info', ['id'=>$book_id])->with('status','Thêm tập mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vol  $vol
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vol  $vol
     * @return \Illuminate\Http\Response
     */
    public function edit($book_id, $vol_id)
    {   
        $v = Vol::query()->findOrFail($vol_id);
        return view('vol.edit', ['v'=>$v]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vol  $vol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $book_id, $vol_id)
    {
        $v = Vol::query()->findOrFail($vol_id);
        $img = $v->img;
        if($request->hasFile('img')) {
            $file = $request->img;
            $file->move(public_path('upload'), $file->getClientOriginalName());
            $img = 'upload/'.$file->getClientOriginalName();  

        }
        $v->title = $request->title;
        $v->img = $img;
        $v->save();
        return redirect()->route('info', $v->book_id)->with('status','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vol  $vol
     * @return \Illuminate\Http\Response
     */
    public function destroy($book_id, $vol_id)
    {
        $v = Vol::query()->findOrFail($vol_id);
        $b_id = $v->book_id;
        $v->delete();
        return redirect()->route('info', ['id'=>$b_id])->with('status','Xóa vol thành công');
    }
}
