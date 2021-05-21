<?php

namespace App\Http\Controllers\Book;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\Book\BookResource;
use App\Media;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    use UploadFileTrait;
    
    public function new()
    {
        $books = Book::where('owner_id', '!=', auth()->id())->latest()->get();
        return response()->json([
            'message' => 'successfully get books',
            'status' => true,
            'data' => BookResource::collection($books)
        ], Response::HTTP_OK);
    }

    public function recommended()
    {
        $books = Book::where('owner_id', '!=', auth()->id())
        ->where('viewer', '>=', 5)->get();
        return response()->json([
            'message' => 'successfully get books',
            'status' => true,
            'data' => BookResource::collection($books)
        ],Response::HTTP_OK);
    }

    public function most()
    {
        $books = Book::where('owner_id', '!=', auth()->id())
        ->where('viewer', '>=', 5)->get();
        return response()->json([
            'message' => 'successfully get books',
            'status' => true,
            'data' => BookResource::collection($books)
        ], Response::HTTP_OK);
    }

    public function me()
    {
        $books = Book::where('owner_id', auth()->id())->get();
        return response()->json([
            'message' => 'successfully get books',
            'status' => true,
            'data' => BookResource::collection($books)
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {

		$validator = Validator::make($request->all(), [
			'category_id' => 'required',
			'title' => 'required',
			'description' => 'required',
			'writer' => 'required',
			'publisher' => 'required',
			'year' => 'required',
			'number_of_pages' => 'required',
			'image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
		]);

		if ($validator->fails()) {
			return response()->json([
                'message' => 'http unprocessable entity',
                'status' => false,
                'data' => $validator->getMessageBag()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
		}

        DB::beginTransaction();
        try {
            $book = Book::updateOrCreate(['id' => $request->id], [
                'category_id' => $request->category_id,
                'owner_id' =>auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'writer' => $request->writer,
				'publisher' => $request->publisher,
				'year' => $request->year,
				'number_of_pages' => $request->number_of_pages,
            ]);

            if($request->id){
                Media::where('model_type', Book::class)->where('model_id', $request->id)->delete();
            }

			Media::create([
				'model_type' => Book::class,
				'model_id' => $book->id,
				'filename' => 'uploads/books/'. $this->uploadImageLocal($request->file('image'), 'books')
			]);

			// Media::create([
			// 	'model_type' => Book::class,
			// 	'model_id' => $book->id,
			// 	'filename' => $this->uploadImage($request->file('image'))
			// ]);
			
            DB::commit();
            return response()->json([
                'message' => 'successfully created book',
                'status' => true,
                'data' => (object)[]
            ],Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
                'data' => (object)[]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get($id)
    {
        $book = Book::where('id', $id)->first();
        $book->update([
            'viewer' => $book->viewer + 1
        ]);
        return response()->json([
            'message' => 'successfully get book',
            'status' => true,
            'data' => new BookResource($book)
        ],Response::HTTP_OK);
    }

    public function delete($id)
    {
        Book::destroy($id);
        Media::where('model_type', Book::class)->where('model_id', $id)->delete();
        return response()->json([
            'message' => 'successfully deleted book',
            'status' => true,
            'data' => (object)[]
        ], Response::HTTP_OK);
    }
}
