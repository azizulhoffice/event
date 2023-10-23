<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
        // return view('home');
    }
    public function regStatusUpdate(Request $request){
       if($request->status == "on"){
          $data = [
              'key' => 'registration',
              'value' => 'open'
          ];
       }
       else{
            $data = [
                'key' => 'registration',
                'value' => 'closed'
            ];
       }
         $res = Setting::where('key', 'registration')->update($data);
            if($res){
                return redirect()->back()->with('success', 'Registration Status Updated');
            }
            else{
                return redirect()->back()->with('error', 'Registration Status Not Updated');
            }
    }
}
