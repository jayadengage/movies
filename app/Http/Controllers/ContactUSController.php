<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContactUS;
use Mail;

class ContactUSController extends Controller
{
    //

    public function contactUS()
    {
    	return view('contactUS');
    }

    public function contactUSPost(Request $request){
    	$this->validate($request,[
         'name' => 'required',
         'email' => 'required',
         'messege' => 'required'
    	]);

    	ContactUS::create($request->all());

    	Mail::send('email',
        array(
          'name' =>$request->get('name'),
          'email' => $request->get('email'),
          'user_messege' => $request->get('messege')
        ), function($messege)
        {
          $messege->from('jay.upadhyay@adengage.in');
          $messege->to('jay.upadhyay@adengage.in','Admin')->subject('testing');
        });
    	return back()->with('success', 'Thank for contacting us!');
    }
}
