<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller as BaseController;
use App\Middlewares\Test;
use App\Core\Request;
use App\Core\Response;
use App\Core\Traits\Utils\CommonHelpers;
use App\Core\Validator;
use App\Models\UserModel;

class HomeController extends BaseController
{
    use CommonHelpers;

    /**
     * Load functions  like middleware etc that runs before 
     * other controller methods
     * @return void
     */
    public function load(): void
    {
        // You can init controller level middleware like this: new Test();
    }

    public function index()
    {
        $this->app->view->toView(
            $path = 'homepage',
            $data = []
        );
    }

    public function store()
    {
        $this->dd(Request::getBody(), Request::getQuery());
    }

    public function test()
    {
        $users = UserModel::all()->toJson();

        // $response = (new Response)->setHeaders([
        //     // "Expires: Sun, 22 Jun 1997 04:00:00 GMT",
        //     // "Cache-Control: no-cache, must-revalidate",
        //     // "Pragma: no-cache"
        // ]);

        // $response->view()->toView(
        //     $path = 'homepage',
        //     $data = []
        // );
        $this->dd(           
        //     // (new Validator((new Request()), [
        //     //     'name' => ['string', 'empty']
        //     // ]))->validate(),
        //     // Application::$app->database,
        //     // $userModel
            $users
        );
    }
}
