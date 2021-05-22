<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
          'name' => 'Cole'
        ];
        return $this->render('home', $params);
    }


}