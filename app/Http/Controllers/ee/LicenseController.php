<?php

namespace App\Http\Controllers\ee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ee\License;
use App\Setting;

class LicenseController extends Controller
{
    public function show()
    {
        $license = License::import();

        return view('admin.license.show', compact('license'));
    }

    public function store()
    {
        if (request()->file()) {
            $path = request()->file('webapp_license')->getPathName();

            if ($path) {

                Setting::create([
                    'key' => License::LICENSE_SETTING_KEY,
                    'value' => file_get_contents($path)
                ]);

            }
        }
        

        return back();
    }

    public function destroy()
    {
        $license = Setting::where('key', License::LICENSE_SETTING_KEY)->first();

        if ($license->delete()) {
            return response('OK', 200);
        }

        return response('Something went wrong ...', 404);
    }
}
