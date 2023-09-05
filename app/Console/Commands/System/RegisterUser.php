<?php

namespace App\Console\Commands\System;

use App\UseCases\User\UserRegistrationUseCase;
use Illuminate\Console\Command;
use Illuminate\Validation\ValidationException;

class RegisterUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:register-user {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Регистрация нового пользователя в системе';

    /**
     * Execute the console command.
     *
     * @param UserRegistrationUseCase $useCase
     *
     * @return int
     *
     * @throws ValidationException
     */
    public function handle(UserRegistrationUseCase $useCase): int
    {
        return $useCase->execute(
            (string)$this->argument('email'),
            (string)$this->argument('password')
        );
    }
}
