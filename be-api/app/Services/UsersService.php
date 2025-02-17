<?php

namespace App\Services;

use App\DTOs\AuthenticateUser;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Contracts\UsersServiceInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class UsersService implements UsersServiceInterface
{

    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }
    /**
     * @param  AuthenticateUser  $dto
     * @return array{token: string}
     */
    public function authenticateUser(AuthenticateUser $dto): array
    {
        /** @var ?User $user */
        $user = $this->userRepository->findByEmail($dto->getEmail());

        if (! $user) {
            throw new NotFoundHttpException('Users not found', null, Response::HTTP_NOT_FOUND);
        }

        if (! Hash::check($dto->getPassword(), $user->password)) {
            throw new UnauthorizedException('Invalid password', Response::HTTP_UNAUTHORIZED);
        }

        $user->revokeExistingTokens();

        return $user->createAuthToken();
    }
}
