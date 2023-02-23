<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Class View
 * 
 * @author Adeola Bada <dunsin.bada@gmail.com>
 * @package App\Core
 */
class View
{
    public mixed $twig;

    public function __construct(string $path, string $cache_path)
    {
        $loader = new \Twig\Loader\FilesystemLoader($path);
        $this->twig = new \Twig\Environment($loader, [
            'cache' => $cache_path,
        ]);
    }
}
