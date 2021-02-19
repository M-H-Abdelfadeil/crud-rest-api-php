<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Content-type: application/json; charset=utf-8");

include '../../vendor/autoload.php';
use \Firebase\JWT\JWT;
