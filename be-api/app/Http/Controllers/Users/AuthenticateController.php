<?php

namespace App\Http\Controllers\Users;

use App\DTOs\AuthenticateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AuthenticateUserRequest;
use App\Services\Contracts\UsersServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateController extends Controller
{
    public function __construct(private readonly UsersServiceInterface $service)
    {
        //
    }

    public function __invoke(AuthenticateUserRequest $request): JsonResponse
    {
        try {
            $dto = new AuthenticateUser(
                email: $request->validated('email'),
                password: $request->validated('password')
            );

            $response = $this->service->authenticateUser($dto);

            return response()->json([
                'message' => 'User authenticated successfully',
                'data' => $response
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->logAndRespondWithError($e, 'Authentication failed');
        }
    }
}
