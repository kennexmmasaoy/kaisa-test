<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function index()
    {
        return view('books');
    }

    public function newBook()
    {
        return view('book-add');
    }

    public function addEditBook(Request $request,$data)
    {
        $info = $request->all();
        // dd($info);
        if(sizeof($info)    ){
            $book = new BookModel();
            $result = $book->getData($info['id']);  
        }else{  
            return view('book-add');  
        }
        return view('book-add')->with('result',$result);
    }
}
