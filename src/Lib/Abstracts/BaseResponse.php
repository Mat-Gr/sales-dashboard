<?php

namespace App\Lib\Abstracts;


use Stringable;

abstract class BaseResponse implements Stringable
{
    abstract public function __toString(): string;

    private int $status = 200;

    public function setStatus(int $code): static
    {
        $this->status = $code;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

}
