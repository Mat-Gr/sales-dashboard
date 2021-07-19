<?php


namespace App\Lib;


use App\Lib\Abstracts\BaseResponse;

class HtmlResponse extends BaseResponse
{
    private string $template;

    public function __construct(string $template)
    {
        $this->template = $template;
    }

    public function __toString(): string
    {
        return $this->renderTemplate();
    }

    private function renderTemplate(): string
    {
        ob_start();

        include dirname(__DIR__, 2)."/templates/{$this->template}.php";

        return ob_get_clean();
    }
}
