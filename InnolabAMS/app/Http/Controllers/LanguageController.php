<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang(Request $request)
    {
        $lang = $request->lang;
        \Log::info('Language switch attempted', ['lang' => $lang]);

        if (in_array($lang, ['en', 'tl'])) {
            Session::put('locale', $lang);
            App::setLocale($lang);
            \Log::info('Language switched successfully');
            return response()->json(['status' => 'success']);
        }
        \Log::error('Invalid language selected');
        return response()->json(['status' => 'error'], 400);
    }
}
