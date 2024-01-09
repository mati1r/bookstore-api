<?php

namespace App\Http\Controllers\Api;

use App\Filters\BookFilter;
use App\Http\Resources\BookCollection;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new BookFilter();
        $filterItems = $filter->transform($request);

        $paginated = $request->query("paginated");

        $books = Book::where($filterItems);

        $books = $books->with('authors');
        $books = $books->with('genres');

        //If paginated=true
        if($paginated)
        {    
            return new BookCollection($books->paginate()->appends($request->query()));
        }
        else
        {
            return new BookCollection($books->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $pictureFile = $request->file('picture');

        if (!$pictureFile) {
            return response()->json([
                "message" => "Picture not sended"
            ], 401);
        }

        $pictureBase64 = base64_encode(file_get_contents($pictureFile->getRealPath()));
        error_log($pictureBase64);

        $book = Book::create([
            'publisher' => $request->input('publisher'),
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'publish_year' => $request->input('publish_year'),
            'picture' => $pictureBase64
        ]);

        // Dodaj relacje z autorami
        $book->authors()->attach($request->input('author_ids'));

        // Dodaj relacje z gatunkami
        $book->genres()->attach($request->input('genre_ids'));

        // Zwróć utworzoną książkę w odpowiedzi
        return new BookCollection([$book]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
