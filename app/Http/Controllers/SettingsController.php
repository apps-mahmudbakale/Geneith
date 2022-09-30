<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings\StoreSettings;

class SettingsController extends Controller
{
    public function index(StoreSettings $settings){
        return view('settings.index',compact('settings'));
    }  
    
    function updateStoreSettings(Request $request, StoreSettings $settings)
    {
        $this->validate($request,[
                    'store_name' => 'required',
                    'store_address' => 'required',
                    'store_logo' => 'nullable|file|image',

                ]);

                $logo = '';
                if($request->hasFile('store_logo')){
                    $logo = time().'.'.$request->store_logo->extension();
                    $request->store_logo->move(public_path('storage/settings/store'), $logo);
                }

                $settings->store_name = $request->store_name;
                $settings->store_logo = $logo;
                $settings->store_address = $request->store_address;
                $settings->save();
                return back()->with('Store Settings Has Been Updated');

    }

}
