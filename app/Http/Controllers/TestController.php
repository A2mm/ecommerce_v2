<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use SoapClient;
use DB;
use Session;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App;
use Mail;



class TestController extends Controller{
	public function getRegister(){
	
      return view('test.email');
    }


    public function send(Request $request){

      $this->validate($request, [
          'name' => 'required|max:255',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:6'
      ]);

      $contactEmail = $request['email'];
      $sub = "gfhjk";
      //$content = $request['name'];
      $code = str_random(6);
      Mail::send('test.z', ['code' => $code], function ($message)  use ($contactEmail,$sub)
        {
            $message->from('me@gmail.com', 'Luxgems');
            $message->to($contactEmail);
            $message->subject($sub);
        });
      $user = User::create([
          'name' => $request['name'],
          'email' => $request['email'],
          'password' => bcrypt($request['password']),
          'type' => $request['type'],
          'status' => 0,
          'code' => $code,
      ]);

      return redirect('/')->with('message', 'check your email to be confirmed');
} 

  public function verify($code) {

      $user = User::where('code', $code)->first();
      if(count($user)){
        $user->update([
          'status' => 1
          ]);
        Auth::login($user, true);
      return redirect('/');
        
      }
  }
}