<?php

require 'api/fetch.php';
require 'api/DataClass.php';
require 'api/StoreClass.php';

$e = "https://trial.craig.mtcserver15.com/api/properties";
$p = array("api_key" => "2S7rhsaq9X1cnfkMCPHX64YsWYyfe1he","page"=>"100");
    
$u = $e.'?'.http_build_query($p);
$check = new DataClass($e,$p,$u);
$detail = $check->fetch_data_from_api();