<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

class Request
{
    private string $input;
    private array $body;
    private array $uri;
    private string $method;

    public const PUT = 'PUT';
    public const PATCH = 'PATCH';
    public const GET = 'GET';
    public const DELETE = 'DELETE';

    public function __construct(string $input)
    {
        $this->body = json_decode($input, true) ?? [];
        $this->uri = explode('/', $_SERVER["REQUEST_URI"]);
        $this->method = $_SERVER["REQUEST_METHOD"];
    }
    public function getBody() {
        return $this->body;
    }
    public function getService() {
        return $this->uri[1];
    }
    public function getCommand() {
        return $this->uri[2];
    }
    public function getMethod() {
        return $this->method;
    }
}