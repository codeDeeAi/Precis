<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Class Request
 * 
 * @author Adeola Bada <dunsin.bada@gmail.com>
 * @package App\Core
 */
class Request
{
    public array $placeholder;
    /**
     * Get request server/details
     * @return array
     */
    public static function server(): array
    {
        return $_SERVER;
    }
    /**
     * Get current request path
     * @return String
     */
    public static function getPath(): string
    {
        return parse_url($_SERVER['REQUEST_URI'])['path'];
    }

    /**
     * Get current request full path
     * @return String
     */
    public static function getFullPath(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Get current request query params
     * @param Boolean $toString defaults to false
     * @return Array
     */
    public static function getQuery(bool $toString = false): array
    {
        $url_components = parse_url(self::getFullPath());

        if (!isset($url_components['query'])) return [];

        $string_query = explode('&', $url_components['query']);

        if ($toString) {
            return $string_query;
        }

        $result = [];

        foreach ($string_query as $value) {
            $value_array = explode('=', $value);
            $result[$value_array[0] ?? ''] = $value_array[1] ?? '';
        }

        return $result;
    }

    /**
     * Check if current request query params has value
     * @param String $key
     * @return Boolean
     */
    public static function queryHasKey(string $key): bool
    {
        return array_key_exists($key, self::getQuery());
    }

    /**
     * Get query item value
     * @param String $key
     * @return Mixed 
     */
    public static function getQueryItem(string $key): mixed
    {
        return (self::queryHasKey($key)) ? self::getQuery()[$key] : null;
    }

    /**
     * Get current request method
     * @param Boolean $toLowerCase
     * @return String
     */
    public static function getMethod(bool $toLowerCase = false): string
    {
        $method = $_SERVER['REQUEST_METHOD'];

        return ($toLowerCase)
            ? strtolower($method)
            : $method;
    }

    /**
     * Get request body
     * @return Array
     */
    public static function getBody(): array
    {
        $body = [];
        $method = self::getMethod($toLowerCase = true);

        if ($method === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($method === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    /**
     * Check if request method matches specified type
     * @param String $method
     * @return Boolean
     */
    public static function isMethod(string $method): bool
    {
        return (self::getMethod($toLowerCase = true) === strtolower($method)) ? true : false;
    }
}
