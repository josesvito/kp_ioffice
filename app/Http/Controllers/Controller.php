<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function login(Request $request) {
        $data = $request->all();
        if ($data['username'] == 'admin' & $data['password'] == 'admin') {
            return redirect()->action('Controller@viewHome');
        }
        return back()->with('error', 'Invalid username/password');
    }

    public function viewHome() {
        return view('admin', ['selectedView' => 'home']);
    }

}
