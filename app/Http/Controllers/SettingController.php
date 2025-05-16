<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Str;

class SettingController extends Controller
{
    // public function index()
    // {
    //     $setting = Setting::first();
    //     return view('setting.generalSetting', [
    //         'setting' => $setting,
    //     ]);
    // }

    public function index(Request $request)
    {
        $settings = Setting::all();
        $language = ['fr' => 'French', 'en' => 'English', 'es' => 'Spanish', 'it' => 'Italian', 'de' => 'German', 'bn' => 'Bengali', 'tr' => 'Turkish', 'ru' => 'Russian', 'in' => 'Hindi', 'pt' => 'Portuguese', 'id' => 'Indonesian', 'ar' => 'Arabic'];
        return view('setting.generalSetting', ['settings' => $settings, 'language' => $language]);
    }

    public function doctorino_settings_store(Request $request)
    {

        $validatedData = $request->validate([
            'system_name' => 'required',
            'system_name_short' => 'required',
            'title' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'hospital_email' => 'required|email',
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048|dimensions:max_width=300,max_height=100',
        ]);

        Setting::update_option('system_name', $request->system_name);
        Setting::update_option('system_name_short', $request->system_name_short);
        Setting::update_option('title', $request->title);
        Setting::update_option('address', $request->address);
        Setting::update_option('phone', $request->phone);
        Setting::update_option('hospital_email', $request->hospital_email);
        // Setting::update_option('language', $request->language);

        if ($request->hasFile('logo')) {

            // We Get the image
            $file = $request->file('logo');
            // We Add String to Image name
            $fileName = Str::random(15) . '-' . $file->getClientOriginalName();
            // We Tell him the uploads path
            $destinationPath = public_path() . '/uploads/';
            // We move the image to the destination path
            $file->move($destinationPath, $fileName);
            // Add fileName to database

            Setting::update_option('logo', $fileName);
        }

        return redirect()->back()->with('success', __('Settings edited Successfully'));
    }
}
