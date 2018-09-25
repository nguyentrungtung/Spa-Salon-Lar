<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::latest()->first();
        return view('setting.index',compact('setting'));
    }
    public function store(Request $request)
    {
        $sett = Setting::all();
        $set = count($sett);
        if($set == 0)
        {
            $settings = new Setting;
            $settings->header_name = $request->header_name;
            $settings->footer_name = $request->footer_name;
            $settings->header_text_color = $request->header_text_color;
           // $settings->menu_background_color = $request->menu_background_color;
           // $settings->menu_hover_color = $request->menu_hover_color;
            $settings->menu_text_color = $request->menu_text_color;
            $settings->menu_icon_color = $request->menu_icon_color;
            $settings->menu_font_size = $request->menu_font_size;
            $settings->content_text_size = $request->content_text_size;
            if($request->hasFile('header_logo'))
            {
                //$filename = $request->profile_image->getClientOriginalName();
               $settings->header_logo = $request->header_logo->store('images'); 
            }
            if($request->hasFile('app_logo'))
            {
                //$filename = $request->profile_image->getClientOriginalName();
               $settings->app_logo = $request->app_logo->store('images'); 
            }
            if($request->hasFile('favicon'))
            {
                //$filename = $request->profile_image->getClientOriginalName();
               $settings->favicon = $request->favicon->store('images'); 
            }
            $settings->save();
            return back();

        }
        else
        {
            $setting = Setting::latest()->first();
            $setting->header_name = $request->header_name;
            $setting->footer_name = $request->footer_name;
            $setting->header_text_color = $request->header_text_color;
            //$setting->menu_background_color = $request->menu_background_color;
           // $setting->menu_hover_color = $request->menu_hover_color;
            $setting->menu_text_color = $request->menu_text_color;
            $setting->menu_icon_color = $request->menu_icon_color;
            $setting->menu_font_size = $request->menu_font_size;
            $setting->content_text_size = $request->content_text_size;
            if($request->hasFile('header_logo'))
            {
               
               $setting->header_logo = $request->header_logo->store('images'); 
            }
            if($request->hasFile('app_logo'))
            {
                //$filename = $request->profile_image->getClientOriginalName();
               $setting->app_logo = $request->app_logo->store('images'); 
            }
            if($request->hasFile('favicon'))
            {
                //$filename = $request->profile_image->getClientOriginalName();
               $setting->favicon = $request->favicon->store('images'); 
            }
            $setting->save();
            return back();
        }
    }
}
