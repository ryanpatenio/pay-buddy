<?php

namespace App\Http\Controllers;

use App\Models\UserRequests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestsController extends Controller
{
    public function request_index(){

        $requests = $this->showRequestByUser();

        return view('users.request.request',compact('requests'));
    }
    public function newRequest(Request $request){
       
        $validator = validator($request->all(),[
            'req' => 'required|string'
        ]);
        if($validator->fails()){
            return json_message(EXIT_FORM_NULL,'validation Error',$validator->errors());
        }
        $user_id = Auth::id();

        $find = UserRequests::where('user_id',$user_id)->whereDate('created_at',Carbon::today())->first();
        if(!empty($find)){
            return json_message(EXIT_FORM_NULL,'You can request once every day!');
        }
       
        try {

            UserRequests::create([
                'user_id'=> $user_id,
                'message' => 'Request to Authorize create api for Dev purposes!',
               
            ]);
            #success
            return json_message(EXIT_SUCCESS,'ok');
            
        } catch (\Throwable $th) {
            be_logs('failed to create request',$th);
           return json_message(EXIT_BE_ERROR,'Failed to create requests!');
        }
        
    }

    public function showRequestByUser(){
        $user_id = Auth::id();
    
        $data = UserRequests::where('user_id', $user_id)
            ->selectRaw('message, status, DATE_FORMAT(created_at, "%M %e, %Y, %h:%i %p") as date_created')
            ->orderBy('created_at', 'DESC')
            ->get();
    
        return $data;
    }
}
