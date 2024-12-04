<?php

namespace Modules;

class ApiConnect
{
    private string $url;
    private array $headers;
    private array $options;
    public function setHeaders($value)
    {
        return $this->headers = $value;
    }

    public function setUrl(string $value): string
    {
        return $this->url = $value;
    }

    public function setOptions($value)
    {
        return $this->options = $value;
    }
}