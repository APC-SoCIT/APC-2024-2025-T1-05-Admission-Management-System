<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function __construct()
    {
        // Add middleware if needed
        $this->middleware('web');
    }

    public function switchLang(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'lang' => 'required|string|max:3'
            ]);

            // Verify language exists in database
            $language = Language::where('code', $validated['lang'])->firstOrFail();

            // Store in session and set locale
            Session::put('locale', $language->code);
            App::setLocale($language->code);

            // Log successful language change
            Log::info('Language switched successfully', [
                'user_id' => auth()->id() ?? 'guest',
                'language' => $language->code
            ]);

            return response()->json([
                'status' => 'success',
                'message' => __('Language switched to :language', ['language' => $language->name]),
                'locale' => App::getLocale()
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Invalid language code requested', [
                'code' => $request->input('lang')
            ]);

            return response()->json([
                'status' => 'error',
                'message' => __('Invalid language selected')
            ], 404);

        } catch (\Exception $e) {
            Log::error('Language switch failed', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => __('Failed to switch language. Please try again.')
            ], 500);
        }
    }
}
