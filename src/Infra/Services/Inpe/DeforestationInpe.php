<?php
namespace Src\Infra\Services\Inpe;

use Src\Infra\Http\HttpAdapter;

class DeforestationInpe 
{
    private HttpAdapter $http;
    private static string $baseUrl = 'http://terrabrasilis.dpi.inpe.br/dashboard/api/v1/redis-cli';

    public function __construct(HttpAdapter $http)
    {
        $this->http = $http;
    }

    public function listApplications(): array
    {
        $url = self::$baseUrl . '/apps/identifier';

        $header = [
            'Content-Type: application/json',
            'Access-Control-Allow-Origin: *'
        ];

        return $this->http->get($url, $header);
    }

    public function listPeriods(string $appIdentifier): array
    {
        $url = self::$baseUrl . '/config/periods';
        
        $header = [
            "Content-Type: application/json",
            "Access-Control-Allow-Origin: *",
            "App-Identifier: {$appIdentifier}",
        ];

        return $this->http->get($url, $header);
    }

    public function listClasses(string $appIdentifier): array
    {
        $url = self::$baseUrl . '/config/classes';
        
        $header = [
            "Content-Type: application/json",
            "Access-Control-Allow-Origin: *",
            "App-Identifier: {$appIdentifier}",
        ];

        return $this->http->get($url, $header);
    }

    public function listLois(string $appIdentifier): array
    {
        $url = self::$baseUrl . '/config/lois';
        
        $header = [
            "Content-Type: application/json",
            "Access-Control-Allow-Origin: *",
            "App-Identifier: {$appIdentifier}",
        ];

        return $this->http->get($url, $header);
    }

    public function listLoiNames(string $appIdentifier): array
    {
        $url = self::$baseUrl . '/config/loinames';
        
        $header = [
            "Content-Type: application/json",
            "Access-Control-Allow-Origin: *",
            "App-Identifier: {$appIdentifier}",
        ];

        return $this->http->get($url, $header);
    }

    public function listFilters(string $appIdentifier): array
    {
        $url = self::$baseUrl . '/config/filters';
        
        $header = [
            "Content-Type: application/json",
            "Access-Control-Allow-Origin: *",
            "App-Identifier: {$appIdentifier}",
        ];

        return $this->http->get($url, $header);
    }
}