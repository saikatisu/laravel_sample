<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Requests\BookRequest;
use App\Book;

class BookController extends Controller
{
    public function index(){
        
        // DBよりBookテーブルの値を全て取得
        $books = Book::all();

        // 取得した値をビューに渡す
        return view('book/index',compact('books'));

    }

    public function edit($id){

        // DBよりURLパラメータと同じIDを持つBookの情報を取得
        $book = Book::findOrFail($id);

        // 取得した値をビューに渡す
        return view('book/edit',compact('book'));
    }

    // public function update(BookRequest $request, $id)
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->name = $request->name;
        $book->price = $request->price;
        $book->author = $request->author;
        $book->save();

        return redirect("/book");
    }

    public function destroy($id){
        $book = Book::findOrFail($id);
        $book->delete();
    
        return redirect("/book");
    }

    public function create(){

        // 空の$bookを渡す
        $book = new Book();
        return view('book/create', compact('book'));

    }

    // public function store(BookRequest $request)
    public function store(Request $request)
    {
        extract(\Psy\Shell::debug(get_defined_vars()));
        $book = new Book();
        $book->name = $request->name;
        $book->price = $request->price;
        $book->author = $request->author;
        $book->save();

        return redirect("/book");
    }
}
