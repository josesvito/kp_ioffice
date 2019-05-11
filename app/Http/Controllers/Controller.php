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

    private $user;

    public function login(Request $request) {
        $data = $request->all();
        if ($data['email'] == 'asd@asd.com' & $data['password'] == 'asd') {
            return redirect()->action('Controller@viewHome');
        } else {
            return redirect('login');
        }
    }

    public function viewHome() {
        return view('admin', ['selectedView' => 'home']);
    }

}
