<?php

namespace App\Repositories;

use App\Entities\Book;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class BookRepository 
{
  /**
     * @var EntityRepository
     */
    private $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->repository = $entityManager->getRepository(Book::class);
        $this->em = $entityManager;
    }

    public function find(int $id): ?Book
    {
        return $this->repository->find($id);
    }

    public function findAll()
    {
        return $this->repository->findBy(array());
    }    
}