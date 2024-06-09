<?php

declare(strict_types=1);

namespace App\Domains\Alisa\Services;

use App\Domains\Alisa\Interfaces\DoItForAlisaInterface;
use App\Domains\Alisa\ValueObject\Request;

class Replier
{
    /** @var string[]  */
    private array $answers;

    /** @var DoItForAlisaInterface[] */
    private array $actions;
    private string $firstAnswer;
    private string $defaultAnswer;

    public function __construct(string $firstAnswer, string $defaultAnswer, array $answers, array $actions)
    {
        $this->firstAnswer = $firstAnswer;
        $this->defaultAnswer = $defaultAnswer;
        $this->answers = $answers;
        $this->actions = $actions;
    }

    public function hello(): string
    {
        return $this->firstAnswer;
    }

    /**
     * @param string $input
     *
     * @return string
     */
    public function reply(string $input): string
    {
        return $this->answers[$input] ?? $this->defaultAnswer;
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function doAndReply(Request $request): string
    {
        $command = $request->getCommand();
        if (
            isset($this->actions[$command])
            && $this->actions[$command] instanceof DoItForAlisaInterface
            && !empty($newAnswer = $this->actions[$command]->doItForAlisaAndReply($request))
        ) {
            return $newAnswer;
        }
        return $this->reply($command);
    }

}
