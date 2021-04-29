<?php

namespace App\Http\Controllers\Book;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\Book\BookResource;
use App\Media;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    use UploadFileTrait;
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function new()
    {
        $books = Book::where('owner_id', '!=', auth()->id())->latest()->get();
        return response()->json([
            'message' => 'successfully get books',
            'status' => true,
            'data' => BookResource::collection($books)
        ]);
    }

    public function recommended()
    {
        $books = Book::where('owner_id', '!=', auth()->id())
        ->where('viewer', '>=', 5)->get();
        return response()->json([
            'message' => 'successfully get books',
            'status' => true,
            'data' => BookResource::collection($books)
        ]);
    }

    public function most()
    {
        $books = Book::where('owner_id', '!=', auth()->id())
        ->latest()->get();
        return response()->json([
            'message' => 'successfully get books',
            'status' => true,
            'data' => BookResource::collection($books)
        ]);
    }

    public function me()
    {
        $books = Book::where('owner_id', auth()->id())->get();
        return response()->json([
            'message' => 'successfully get books',
            'status' => true,
            'data' => BookResource::collection($books)
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $book = Book::updateOrCreate(['id' => $request->id], [
                'category_id' => $request->category_id,
                'owner_id' =>auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'writer' => $request->writer,
            ]);

            if($request->id){
                Media::where('model_type', Book::class)->where('model_id', $request->id)->delete();
            }
            $images = $request->images;
            foreach ($images as $image) {
                Media::create([
                    'model_type' => Book::class,
                    'model_id' => $book->id,
                    'filename' => $this->uploadImage($image)
                ]);
            }

            DB::commit();
            return response()->json([
                'message' => 'successfully created book',
                'status' => true,
                'data' => (object)[]
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }

    public function get($id)
    {
        $book = Book::where('id', $id)->first();
        $book->update([
            'viewer' => $book++
        ]);
        return response()->json([
            'message' => 'successfully get book',
            'status' => true,
            'data' => new BookResource($book)
        ]);
    }

    public function delete($id)
    {
        Book::destroy($id);
        Media::where('model_type', Book::class)->where('model_id', $id)->delete();
        return response()->json([
            'message' => 'successfully deleted book',
            'status' => true,
            'data' => (object)[]
        ]);
    }
}
