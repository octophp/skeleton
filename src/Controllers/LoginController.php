<?php declare (strict_types = 1);

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Octo\Encore\Controllers\Controller;
use Octo\Encore\Services\AuthService;

class LoginController extends Controller
{
    /**
     * @Inject
     * @var Octo\Encore\Services\AuthService
     */
    private $authService;

   public function login(ServerRequestInterface $request): JsonResponse
    {
        $body = $request->getParsedBody();
        $email = $body['email'];
        $password = $body['password'];

        $auth = $this->authService->handleLogin($email, $password);
        if ($auth){
            return $this->view(['accessToken' => $auth]);
        }
        return $this->view(['Login failed'], 401);
    }
}