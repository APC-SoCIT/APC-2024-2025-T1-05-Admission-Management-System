<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function switchLang(Request $request)
    {
        try {
            $lang = $request->input('lang');

            if (!in_array($lang, ['en', 'fil'])) {
                throw new \Exception('Invalid language selected');
            }

            Session::put('locale', $lang);
            App::setLocale($lang);

            return response()->json([
                'status' => 'success',
                'message' => 'Language switched successfully',
                'locale' => App::getLocale()
            ]);

        } catch (\Exception $e) {
            Log::error('Language switch failed', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
