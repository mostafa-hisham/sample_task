<?php

/**
 * Created by PhpStorm.
 * User: mostafa
 * Date: 03/02/2017
 * Time: 07:23 Õ
 */

/**
 * Class App
 * Routes to Controller and method based on url
 */
class App
{
    protected $controller = 'Employees';
    protected $method = 'index';
    protected $prams = array();

    public function __construct()
    {
        $url = ($this->parsUrl());
        /*
         * get Controller name from url
         */
        if (file_exists("../app/controllers/{$url[0]}.php")) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        /*
         * Loads and create Controller
         */
        require_once("../app/controllers/{$this->controller}.php");
        $this->controller = new $this->controller;

        /*
         * get the method from url
         */
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        /*
         * get the parameters from url
         */
        $this->prams = $url ? array_values($url) : array();

        call_user_func_array([$this->controller, $this->method], $this->prams);
    }

    /*
     * split url string by '/' and returns url as an array
     * @return array
     */
    protected function parsUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}