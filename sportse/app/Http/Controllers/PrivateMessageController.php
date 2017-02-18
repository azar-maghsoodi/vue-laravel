<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrivateMessage;
use App\Http\Requests;

class PrivateMessageController extends Controller
{
    //

    public function  getUserNotifications(Request $request)
    {
    	$notifications=PrivateMessage::where('read',0)
    	->where('receiver_id',$request->user()->id)
    	->orderBy('created_at','desc')
    	->get();

    	return response(['data'=>$notifications],200);

    }


    public function  getPrivateMessages(Request $request)
    {

    	if ($request->has('name')) {
    		 $pms = PrivateMessage::where('receiver_id',$request->id)
	    	->orderBy('created_at','desc')
	    	->get();
	    	return response(['data'=>$pms],200);
	    	
			}
		else return response(null,410);		

    	
    	
    }


    public function  getPrivateMessageById(Request $request)
    {
    	$pm=PrivateMessage::where('id',$request->input('id'))
    	->first();


    	//change status the message if is not read
    	if($pm->read == 0)
    	{
    		$pm->read = 1;
    		$pm->save();
    	}

    	return response(['data'=>$pm],200);


    	
    }


    public function  getPrivateMessageSent(Request $request)
    {

    	$pms=PrivateMessage::where('sender_id',$request->user()->id)
    	->orderBy('created_at','desc')
    	->get();

    	return response(['data'=>$pms],200);

    	
    }


    public function  sendPrivateMessage()
    {

    	$attributes =[
    	'sender_id' => $request->input('sender_id'),
    	'receiver_id'=>$request->input('receiver_id'),
    	'subject'=>$request->input('subject'),
    	'message'=>$request->input('message'),
    	'read'=>0
    	];

    	$pm=PrivateMessage::create($attributes);
    	$data=PrivateMessage::where('id',$pm->id)->first();
    	    
    	return response(['data'=>$data],201);


    	
    }
}