<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class Controller extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function login(Request $request)
    {
        $data = $request->all();
        if ($data['username'] == 'admin' & $data['password'] == 'admin') {
            return redirect()->action('Controller@viewHome');
        }
        return back()->with('error', 'Invalid username/password');
    }

    public function viewHome()
    {
        $warnedTerms = DB::select('SELECT * FROM perjanjian
        WHERE datediff(current_date(), tanggal_akhir) >= -150 AND
            datediff(current_date(), tanggal_akhir) <= 0');
        $expiredTerms = DB::select('SELECT * FROM perjanjian
        WHERE tanggal_akhir < current_date()');
        return view('admin')
            ->with('selectedView', 'home')
            ->with('warnedTerms', $warnedTerms)
            ->with('expiredTerms', $expiredTerms);
    }
}
