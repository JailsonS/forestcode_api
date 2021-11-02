<?php 
namespace Src\Application\Core;

class Controller 
{
    protected function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    protected function requestData(): array
    {
        switch ($this->method()) {
            case 'GET':
                return $_GET; break;
            case 'DELETE':
                parse_str(file_get_contents('php://input'), $data);
                return (array) $data; break;
            case 'PUT':
                parse_str(file_get_contents('php://input'), $data);
                return (array) $data; break;
            case 'POST':
                $data = json_decode(file_get_contents('php://input'));
                $data = $data?? $_POST; // if null, set post
                return (array) $data; break;
        }
    }

    public function baseUrl(): string
    {
        $base = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://';
        $base .= $_SERVER['SERVER_NAME'];
        if($_SERVER['SERVER_PORT'] != '80') {
            $base .= ':'.$_SERVER['SERVER_PORT'];
        }
        $base .= $_ENV('BASE_URL');
        
        return $base;
    }

	public function returnJson(array $data): void
    {
		header("Content-Type: application/json");
		echo json_encode($data);
		exit;
	}
}
