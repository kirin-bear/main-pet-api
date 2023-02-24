<?php

namespace App\UseCase\User;

use App\Models\KirinBear\User;
use Illuminate\Hashing\HashManager;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;

class UserRegistrationUseCase
{
    private HashManager $hashManager;
    private Factory $factoryValidator;

    public function __construct(Factory $factoryValidator, HashManager $hashManager)
    {
        $this->hashManager = $hashManager;
        $this->factoryValidator = $factoryValidator;
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return int
     *
     * @throws ValidationException
     */
    public function execute(string $email, string $password): int
    {

        $validator = $this->factoryValidator->make([
            'email' => $email
        ], [
            'email' => 'email|unique:users'
        ]);

        $validator->validate();

        $user = new User();
        $user->email = $email;
        $user->name = 'Пользователь #'.rand(0, 99999999);
        $user->password = $this->hashManager->make($password);
        $user->save();

        return $user->id;
    }

}
