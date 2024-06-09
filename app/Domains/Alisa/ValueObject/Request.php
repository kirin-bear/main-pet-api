<?php

declare(strict_types=1);

namespace App\Domains\Alisa\ValueObject;

/**
 * Структура запроса - https://yandex.ru/dev/dialogs/alice/doc/request.html
 */
class Request
{
    private Session $session;
    private string $skillId;
    private string $userId;
    private string $applicationId;
    private array $params;
    private string $command;

    public function __construct(Session $session, string $skillId, string $userId, string $applicationId, string $command, array $params)
    {
        $this->session = $session;
        $this->skillId = $skillId;
        $this->userId = $userId;
        $this->applicationId = $applicationId;
        $this->command = $command;
        $this->params = $params;
    }

    public static function fromArray(array $array): self
    {
        return new self(
            new Session(
                $array['session']['session_id'] ?? '',
                    $array['session']['new'] ?? false
            ),
            $array['session']['skill_id'] ?? '',
            $array['session']['user']['user_id'] ?? '',
            $array['session']['application']['application_id'] ?? '',
            $array['request']['command'] ?? '',
            $array
        );
    }


    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function getSkillId(): string
    {
        return $this->skillId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getApplicationId(): string
    {
        return $this->applicationId;
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    public function getSession(): Session
    {
        return $this->session;
    }

}
