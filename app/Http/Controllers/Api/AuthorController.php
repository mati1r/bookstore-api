<?php

namespace App\Http\Controllers\Api;

use App\Filters\AuthorFilter;
use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use \Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new AuthorFilter();
        $filterItems = $filter->transform($request);

        $authors = Author::where($filterItems)->get();

        return new AuthorCollection($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        return Author::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
    }
}
