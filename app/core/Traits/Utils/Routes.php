<?php

declare(strict_types=1);

namespace App\Core\Traits\Utils;

trait Routes
{
    /**
     * Return view
     * @param string $path
     * @param array $data - defaults to []
     * @param string $base_path - defaults to views folder 
     * @param string $extension - defaults to 'twig' 
     * @return Void 
     */
    public function toView(
        string $path,
        array $data = [],
        string $base_path = 'app/views/',
        string $extension = 'php'
    ): void {

        $root = __DIR__ . "/../../../";

        $full_path =
            $root .
            $base_path .
            $this->makeRouteString($path) .
            '.' . $extension;

        if (file_exists($full_path)) {
            ob_start();
            include_once $full_path;
            ob_get_clean();
            return;
        } else {
            http_response_code(404);
        }
    }

    /**
     * Make Route path
     * @param String $path
     * @return String
     */
    private function makeRouteString(string $path): string
    {
        if (str_contains('.', $path)) {
            return str_replace('.', '/', $path);
        }

        return $path;
    }
}
