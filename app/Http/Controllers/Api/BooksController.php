<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateBook;
use App\Http\Resources\BooksResource;
use App\Services\BooksService;

class BooksController extends Controller
{
    protected $bookService;

    public function __construct(BooksService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->bookService->getMyBooks();

        return BooksResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateBook $request)
    {
        $book = $this->bookService->storeNewBook($request->validated());

        return new BooksResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function show($identify)
    {
        $book = $this->bookService->getBook($identify);

        return new BooksResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateBook $request, string $identify)
    {
        $book = $this->bookService->updateBook($identify, $request->validated());

        return response()->json(['message' => 'Updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $identify)
    {
        $book = $this->bookService->deleteBook($identify);

        return response()->json([], 204);
    }
}
