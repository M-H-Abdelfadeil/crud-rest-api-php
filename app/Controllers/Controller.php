<?php
namespace App\Controllers;

use ValidatorFilterPHP\ValidatorPHP;
use ValidatorFilterPHP\FilterPHP;
use Firebase\JWT\JWT;
class Controller{
    
    public $validate;
    public $filter;

    public function __construct()
    {
        
        $this->validate=new ValidatorPHP;
        $this->filter=new FilterPHP;
    }
}