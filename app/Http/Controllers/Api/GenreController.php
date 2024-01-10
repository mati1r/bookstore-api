<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Http\Controllers\Controller;
use App\Filters\GenreFilter;
use App\Http\Resources\GenreCollection;
use App\Http\Resources\GenreResource;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new GenreFilter();
        $filterItems = $filter->transform($request);

        $genres = Genre::where($filterItems)->get();

        return new GenreCollection($genres);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        return Genre::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return new GenreResource($genre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $genre->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre, Request $request)
    {
        $user = $request->user();

        if($user != null && $user->tokenCan('admin')){
            $genre->delete();
        }else{
            return response()->json(['message'=> 'User is not allowed to delete this record'],401);
        }
    }
}
