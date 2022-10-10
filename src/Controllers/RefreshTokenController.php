<?php declare (strict_types = 1);

namespace App\Controllers;

use Octophp\Encore\Services\AuthService;
use Octophp\Encore\Controllers\Controller;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class RefreshTokenController extends Controller
{
    /**
     * @Inject
     * @var Octophp\Encore\Services\AuthService
     */
    private $authService;

    public function handleRefreshToken(ServerRequestInterface $request): JsonResponse
    { 
        $cookies = $request->getCookieParams();
        $token = $cookies['jwt'];
        $foundUser = $this->authService->findByToken($token);
        if (!$foundUser){
            return $this->view([], 403);
        }

        $token = $this->authService->verifyJwt($foundUser, $token);
        return $this->view(['accessToken' => $token]);
    }
}
