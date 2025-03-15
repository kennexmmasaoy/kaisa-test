<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'book_category';
    protected $fillable = ['name', 'description'];

    public function insertData(array $data)
    {
        return self::create($data);
    }

    public function getAllData()
    {
        return \App\Models\BookCategoryModel::all();
    }

    public function getCategory($id)
    {
        return \App\Models\BookCategoryModel::where('category_id',$id)->get();
    }

    public function updateData($id, array $data)
    {
        return \App\Models\BookCategoryModel::where('category_id',$id)->update($data);
    }

    public function deleteData($id){
        return \App\Models\BookCategoryModel::where('category_id',$id)->delete();
    }
    
}
