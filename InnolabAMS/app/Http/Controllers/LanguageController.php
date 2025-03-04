<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang(Request $request)
    {
        try {
            $lang = $request->input('lang');
            \Log::info('Language switch attempted', ['requested_lang' => $lang]);

            if (!in_array($lang, ['en', 'tl'])) {
                throw new \Exception('Invalid language selected');
            }

            Session::put('locale', $lang);
            App::setLocale($lang);

            \Log::info('Language switched successfully', [
                'locale' => App::getLocale(),
                'session_locale' => Session::get('locale')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Language switched successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Language switch failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
