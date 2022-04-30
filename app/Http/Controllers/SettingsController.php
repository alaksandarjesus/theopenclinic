<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\Settings\ClinicInfoRequest;

class SettingsController extends Controller
{
    
    public function index(){
        $settings = Setting::get()->pluck('meta_value', 'meta_key');
        return view('settings.index', compact('settings'));
    }

    public function clinic_info(ClinicInfoRequest $request){
        $validated = (object)$request->validated();
        foreach($validated as $key => $value){
            $value = [
                'meta_value' => $validated->$key,
                'updated_by' => $request->user->id
            ];
            $setting = Setting::where('meta_key', $key)->first();
            if(empty($setting)){
                $setting = new Setting();
                $setting->meta_key = $key;
                $setting->meta_value = $validated->$key;
                $setting->created_by = $request->user->id;
                $setting->updated_by = $request->user->id;
                $setting->save();
            }else{
                Setting::where('meta_key', $key)->update($value);
            }
        }
        
        return response()->json(['success' => true]);
    }
}
