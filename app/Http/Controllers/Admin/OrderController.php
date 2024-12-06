<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class OrderController extends Controller
{

    protected $mainController;

    public function __construct()
    {
        $this->mainController = new MainController();
    }

    public function changeStatus() {}

    public function getDetails() {}

    public function getData(Request $request)
    {
        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];


        if ($request->search) {
            $search = [
                'search' => $request->search,
                'dbSearch' => ['title', 'description']
            ];
        } else $search = [];

        $result = $this->mainController->databaseOperations(['model' => 'App\Models\Main\Order', 'pagination' => $pagination, 'search' => $search, 'returnvalues' => ['items', 'pageCount'], 'create' => false, 'joins' => [['table' => 'users', 'first' => 'user_code', 'operator' => '=', 'second' => 'users.code', 'columns' => ['name' => 'user_name']]]]);

        return $result;
    }
}
