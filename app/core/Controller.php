<?php

/**
 * Created by PhpStorm.
 * User: mostafa
 * Date: 03/02/2017
 * Time: 07:25 Õ
 */
class Controller
{
    /**
     * @param $model
     * @return mixed
     * creates Controller model
     */
    protected function model($model)
    {
        require_once("../app/models/{$model}.php");

        return new $model;
    }

    /**
     * @param $view
     * @param array $data
     * renders view with data
     */
    protected function view($view, $data = [])
    {
        require_once("../app/views/header.php");
        require_once("../app/views/{$view}.php");
        require_once("../app/views/footer.php");

    }
}