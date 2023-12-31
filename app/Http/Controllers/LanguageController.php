<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switchLang(Request $request,$locale)
    {
        Session::put('locale', 'my');
        App::setLocale($locale);
        return redirect()->back();
    }
}
