<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Traits\Utils\CommonHelpers;
use Jenssegers\Blade\Blade as Blade;
use App\Core\Config;

/**
 * Class View
 * 
 * @author Adeola Bada <dunsin.bada@gmail.com>
 * @package App\Core
 */
class View
{
    use CommonHelpers;

    protected Blade $blade;
    protected string $view_root;

    public function __construct()
    {
        $this->view_root = Config::main()['BASE_VIEW_PATH'] ?? dirname(__DIR__, 1) . '/views';
        $this->blade = new Blade($this->view_root, 'cache/views');
    }

    /**
     * Return view
     * @param string $path
     * @param array $data - defaults to []
     * @return Void 
     */
    public function toView(
        string $path,
        array $data = [],
    ): void {

        if (file_exists(
            $this->view_root . '/' .
                $this->makeRouteString($path) .
                '.blade.php'
        )) {
            echo $this->blade->render($this->makeRouteString($path), $data);
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
