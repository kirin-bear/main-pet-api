<?php

declare(strict_types=1);

namespace App\Domains\Alisa\Dto;

/**
 * Структура запроса - https://yandex.ru/dev/dialogs/alice/doc/request.html
 */
class Request
{
    private string $sessionId;
    private string $skillId;
    private string $userId;
    private string $applicationId;
    private array $params;

    public function __construct(string $sessionId, string $skillId, string $userId, string $applicationId, array $params)
    {
        $this->sessionId = $sessionId;
        $this->skillId = $skillId;
        $this->userId = $userId;
        $this->applicationId = $applicationId;
        $this->params = $params;
    }

    public static function fromArray(array $array): self
    {
        return new self(
            $array['session']['session_id'] ?? '',
                $array['session']['skill_id'] ?? '',
                $array['session']['user']['user_id'] ?? '',
                $array['session']['application']['application_id'] ?? '',
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
    public function getSessionId(): string
    {
        return $this->sessionId;
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

}
