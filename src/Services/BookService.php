<?php

namespace App\Services;

use App\Entities\Book;
use App\Repositories\BookRepository;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;

class BookService
{
    /**
     * @Inject
     * @var App\Repositories\BookRepository
     */
    private $bookRepository;

    public function getAllBooks()
    {
        $books = $this->bookRepository->findAll();
        $resource = new Collection($books, function(Book $book) {
            return [
                'id'      => (int) $book->getId(),
                'title'   => $book->getTitle(),
                'links'   => [
                    [
                        'rel' => 'self',
                        'uri' => '/books/'.$book->getId(),
                    ]
                ]
            ];
        });
        $fractal = new Manager();
        $data = $fractal->createData($resource)->toArray();        
        return $data;
    }

    public function find(int $id)
    {
        $book = $this->bookRepository->find($id);
        $resource = new Item($book, function(Book $book) {
            return [
                'id'      => (int) $book->getId(),
                'title'   => $book->getTitle(),
                'links'   => [
                    [
                        'rel' => 'self',
                        'uri' => '/books/'.$book->getId(),
                    ]
                ]
            ];
        });
        $fractal = new Manager();
        $data = $fractal->createData($resource)->toArray();
        return $data;        
    }
}
