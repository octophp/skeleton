<?php declare (strict_types = 1);

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Octo\Encore\Controllers\Controller;
use App\Services\BookService;

class IndexController extends Controller
{
    /**
     * @Inject
     * @var App\Services\BookService
     */
    private $bookService;

   public function index(ServerRequestInterface $request): JsonResponse
    {
        return $this->view(['welcome' => time()]);
    }

    public function books(ServerRequestInterface $request): JsonResponse
    {
        $books = $this->bookService->getAllBooks();
        return $this->view($books);
    }

    public function show(ServerRequestInterface $request, array $args): JsonResponse
    {
        $book = $this->bookService->find((int)$args['id']);
        return $this->view($book);
    }    

     public function top_secret(ServerRequestInterface $request): JsonResponse
    {
        $auth = $request->getAttribute('auth');
        echo $auth->getCode();
        $payload = $request->getAttribute('payload');
        var_dump($auth);
        var_dump($payload);
        die();
        return $this->view([]);
    }
}