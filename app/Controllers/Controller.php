<?php
namespace App\Controllers;
use App\Models\AuthModel;
use ValidatorFilterPHP\ValidatorPHP;
use ValidatorFilterPHP\FilterPHP;
class Controller{
    public $model;
    public $validate;
    public $filter;
    public function __construct()
    {
        $this->model=new AuthModel;
        $this->validate=new ValidatorPHP;
        $this->filter=new FilterPHP;
    }
}