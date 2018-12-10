<?php
namespace App\Http\Controllers;

include app_path()."/includes/ChromePhp.php";
use Illuminate\Http\Request;
use ChromePhp;

class TestController extends Controller
{
    public function test(){
        ChromePhp::table($_SERVER);
//        ChromePhp::log('Hello console!');
//        ChromePhp::log($_SERVER);
//        ChromePhp::warn('something went wrong!');
//        ChromePhp::info($_SERVER);
    }
}
