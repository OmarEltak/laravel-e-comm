<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homepageController extends Controller
{
    public function homePage(){
        return view('front.home_page');
    }
}
