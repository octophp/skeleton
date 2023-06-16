<?php declare (strict_types = 1);

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Octophp\Encore\Controllers\Controller;
use Octophp\Encore\Services\AuthService;
use DI\Attribute\Inject;


class LoginController extends Controller
{
    /**
     * @Inject
     * @var Octophp\Encore\Services\AuthService
     */
    #[Inject(AuthService::class)]
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
        return $this->view(['Login failed' => $auth], 401);
    }
}