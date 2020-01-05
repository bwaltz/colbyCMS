<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

// use App\Http\Resources\SettingsResource;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();

        $newSettings = [];
        $settingsIdMap = [];

        // reformat settings
        foreach ($settings as $setting => $value) {
            $newSettings[$value->key] = json_decode($value->value);
            $settingsIdMap[$value->key] = $value->id;
        }

        return response()->json(['data' => $newSettings, 'settingsIdMap' => $settingsIdMap]);
    }

    public function update(Request $request, Setting $setting)
    {
        $setting->update(['value' => json_encode($request->value)]);
        return response()->json(['status' => 'success']);
    }
}
