<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\LibraryInterface;
use App\Models\BookCategoryModel;
use App\Models\BookModel;

class BookCategoryController extends Controller
{
    //
    public function index()
    {
        return view('bookcategory');
    }

    public function getAllData($type)
    {
        $model = match($type){
            'book' => new BookModel(),
            'category' => new BookCategoryModel(),
            default => null,
        };
        if(!$model ) {
            return response()->json(['error' => 'Invalid Type', 400]);
        }

        $record = $model->getAllData();

        return response()->json(['success' => true, 'data' => $record],200);
    }

    public function saveBookCategory(Request $request, $type)
    {
        $data = $request->all();

        //Map type to model
        $model = match($type){
            'book' => new BookModel(),
            'category' => new BookCategoryModel(),
            default => null,
        };
        if(!$model ) {
            return response()->json(['error' => 'Invalid Type', 400]);
        }

        // Handle Base64 Image
        if (!empty($data['image'])) {
            $imageData = explode(',', $data['image']);
            $imageBase64 = base64_decode(end($imageData));
            $imageName = 'images/' . uniqid() . '.jpg';
            
            // Ensure the directory exists
            $storagePath = storage_path('app/public/images');
            if (!\File::exists($storagePath)) {
                \File::makeDirectory($storagePath, 0775, true);
            }

            $imagePath = public_path('storage/' . $imageName);
            file_put_contents($imagePath, $imageBase64);
            $data['image'] = $imageName;
        }

        $record = $model->insertData($data);

        return response()->json($record);
    }

    public function getData(Request $request, $type)
    {
        $data = $request->all();
        $model = match($type){
            'book' => new BookModel(),
            'category' => new BookCategoryModel(),
            default => null,
        };
        if(!$model ) {
            return response()->json(['error' => 'Invalid Type', 400]);
        }
        $result = $model->getCategory($data['catid']);
        return response()->json(['success' => true, 'data' => $result],200);
    }

    public function updateBookCategory(Request $request, $type)
    {
        $data = $request->all();
        // dd($data);
        //Map type to model
        $model = match($type){
            'book' => new BookModel(),
            'category' => new BookCategoryModel(),
            default => null,
        };
        if(!$model ) {
            return response()->json(['error' => 'Invalid Type', 400]);
        }
        // Handle Base64 Image
        if (!empty($data['image'])) {
            $imageData = explode(',', $data['image']);
            $imageBase64 = base64_decode(end($imageData));
            $imageName = 'images/' . uniqid() . '.jpg';
            
            // Ensure the directory exists
            $storagePath = storage_path('app/public/images');
            if (!\File::exists($storagePath)) {
                \File::makeDirectory($storagePath, 0775, true);
            }

            $imagePath = public_path('storage/' . $imageName);
            file_put_contents($imagePath, $imageBase64);
            $data['image'] = $imageName;
        }

        $record = $model->updateData($data['category_id'],$data);

        return response()->json(['success' => true, 'data' => $record],200);
    }

    public function deleteBookCategory(Request $request, $type){
        $data = $request->all();
        $model = match($type){
            'book' => new BookModel(),
            'category' => new BookCategoryModel(),
            default => null,
        };
        if(!$model ) {
            return response()->json(['error' => 'Invalid Type', 400]);
        }
        $result = $model->deleteData($data['catid']);
        return response()->json(['success' => true, 'data' => $result],200);
    }
}
