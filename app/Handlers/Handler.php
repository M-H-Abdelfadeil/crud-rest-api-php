<?php
namespace App\Handlers;

use ValidatorFilterPHP\ValidatorPHP;
use ValidatorFilterPHP\FilterPHP;

class Handler{
    
    public $validate;
    public $filter;

    public function __construct()
    {
        $this->validate=new ValidatorPHP;
        $this->filter=new FilterPHP;
    }
}