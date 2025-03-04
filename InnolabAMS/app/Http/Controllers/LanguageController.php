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
            Log::info('Language switch request received', [
                'request_data' => $request->all(),
                'headers' => $request->headers->all()
            ]);

            $lang = $request->input('lang');

            if (!in_array($lang, ['en', 'tl'])) {
                Log::warning('Invalid language selected', ['lang' => $lang]);
                throw new \Exception('Invalid language selected');
            }

            Session::put('locale', $lang);
            App::setLocale($lang);

            Log::info('Language switched successfully', [
                'new_locale' => App::getLocale(),
                'session_locale' => Session::get('locale')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Language switched successfully',
                'locale' => App::getLocale()
            ]);
        } catch (\Exception $e) {
            Log::error('Language switch failed', [
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
