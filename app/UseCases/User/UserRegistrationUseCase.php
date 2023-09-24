<?php

namespace App\UseCases\User;

use App\Events\User\Created;
use App\Models\KirinBear\User;
use Illuminate\Events\Dispatcher;
use Illuminate\Hashing\HashManager;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;

class UserRegistrationUseCase
{
    private HashManager $hashManager;
    private Factory $factoryValidator;
    private Dispatcher $dispatcher;

    public function __construct(Factory $factoryValidator, HashManager $hashManager, Dispatcher $dispatcher)
    {
        $this->hashManager = $hashManager;
        $this->factoryValidator = $factoryValidator;
        $this->dispatcher = $dispatcher;
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

        $this->dispatcher->dispatch(new Created($user->id, $user->email));

        return $user->id;
    }

}
