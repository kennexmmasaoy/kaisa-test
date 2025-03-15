<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = ['name', 'author', 'genre', 'condition', 'publication_date', 'category_id', 'image'];

    public function insertData(array $data)
    {
        return self::create($data);
    }

    public function getAllData()
    {
        return \App\Models\BookModel::all();
    }

    public function getData($id)
    {
        // return \App\Models\BookCategoryModel::where('category_id',$id)->get();
        return \App\Models\BookModel::where('book_id',$id)->first();
    }

    public function updateData($id, array $data)
    {
        return \App\Models\BookModel::where('book_id',$data['book_id'])->update($data);
    }

    public function deleteData($id){
        return \App\Models\BookModel::where('book_id',$id)->delete();
    }

}
