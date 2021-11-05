<?php

namespace App\Repositories;

use App\Models\Books;

class BooksRepository
{
    protected $model;

    public function __construct(Books $books)
    {
        $this->model = $books;
    }

    public function getMyBooks()
    {
        return $this->model->with('typeInterest')->where('user_id', auth()->id())->get();
    }

    public function storeNewBook(array $data)
    {
        return $this->model->create($data);
    }

    public function getBookByUuid(string $identify)
    {
        return $this->model
                    ->with('typeInterest')
                    ->where('user_id', auth()->id())
                    ->where('uuid', $identify)
                    ->firstOrFail();
    }

    public function deleteBookByUuid(string $identify)
    {
        $book = $this->getBookByUuid($identify);

        return $book->delete();
    }

    public function updateBookByUuid(string $identify, array $data)
    {
        $book = $this->getBookByUuid($identify);

        return $book->update($data);
    }
}
