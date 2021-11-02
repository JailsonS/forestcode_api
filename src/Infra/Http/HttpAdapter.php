<?php
namespace Src\Infra\Http;

interface HttpAdapter
{
    public function post(string $url, array $header, array $data): array;

    public function get(string $url, array $header): array;
}