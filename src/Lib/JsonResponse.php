<?php


namespace App\Lib;


use App\Lib\Abstracts\BaseResponse;

class JsonResponse extends BaseResponse
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __toString(): string
    {
        header('Content-Type: application/json');

        return json_encode($this->data, JSON_THROW_ON_ERROR);
    }
}
