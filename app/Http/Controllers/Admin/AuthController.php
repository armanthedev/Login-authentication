<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index(){
        return view('Admin/Auth');
    }



    // public function postLogin(Request $request){
    // $validated = $request->validate([
    //     'email'     => 'required|max:20|email:rfc,dns',
    //     'password'  => 'required',
    //     'terms'     => 'required|max:1'
    // ]);

    //     $email = $request->input('email');
    //     $password = $request->input('password');
    //     $terms = $request->input('terms');
        
    //     $admin=DB::table('admin_tb')
    //         ->select('*')
    //         ->where('email',$email)
    //         ->where('status',1)
    //         ->first();

    //      echo '<pre>';
    //      print_r($admin);
    //      die();

    //         if($admin){
    //             if (Hash::check($password, $admin->password)) {
    //                 $data = array(
    //                     'email' => $email,
    //                     'f_name' => $admin -> f_name,
    //                     'l_name' => $admin ->l_name,
    //                     'is_login' =>1,
    //                     'is_admin' =>1
    //                 );
    
    //                 return redirect('dashboard');
    //              }
                 
    //         }else{
    //             return Redirect::back()->withErrors(['error' => 'Wrong Password']);
    //         }
    //      }else{
    //         return Redirect::back()->withErrors(['error' => 'Wrong Email']);
    //      } 
    
    // // The blog post is valid...
    // }

    public function postLogin(request $request){
        $validated = $request->validate([
            'email' => 'required|max:20|email:rfc,dns',
            'password' => 'required',
            'terms' => 'required|max:1'
        ]);

        

        $email = $request->input('email');
        $password = $request->input('password');
        $terms = $request->input('terms');

        $admin    = DB::table('admin_tb')
            ->select('*')
            ->where('email',$email)
            ->where('status',1)
            ->first();
            
         if($admin){
            if (Hash::check($password, $admin->password)) {
                $data = array(
                    'email' => $email,
                    'f_name' => $admin -> f_name,
                    'l_name' => $admin ->l_name,
                    'is_login' =>1,
                    'is_admin' =>1
                );

                // $request->session()->put('admin', $admin);
                //echo "<pre>";
                // print_r($request->session()->get('admin'));
                return redirect('dashboard')->with('status', 'Welcome Back -> '.$admin ->f_name." ".$admin ->l_name);  
                // return redirect('dashboard');
                //die();
            }else{
                return Redirect::back()->withErrors(['error' => 'Wrong Password']);
            }
         }else{
            return Redirect::back()->withErrors(['error' => 'Wrong Email']);
         } 

        // echo '<pre>';
        // print_r($request ->all());
        // print_r($request ->input('password'));
        // echo "<br>";
        // echo $request -> url()."<br>";
        // echo $request -> path();

        //     $rules = [
        //         'email' => 'required|max:20|email:rfc,dns',
        //         'password' => 'required',
        //         'terms' =>'required',
        //     ];
            
        //     $this->validate($request, $rules);
        //     echo '<pre>';
        //     print_r($request ->all());
        //     echo '</pre>';
    }

}
