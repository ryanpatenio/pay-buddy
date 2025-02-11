<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRequests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestsController extends Controller
{
    public function index_user(){

        $requests = $this->showRequestByUser();

        return view('users.request.request',compact('requests'));
    }
    public function index_admin(){

        $requests = $this->showAllRequest();
       

        return view('admin.requests',compact('requests'));
    }

    public function newRequest(Request $request){
       
        $validator = validator($request->all(),[
            'req' => 'required|string'
        ]);
        if($validator->fails()){
            return json_message(EXIT_FORM_NULL,'validation Error',$validator->errors());
        }
        $user_id = Auth::id();

        $isUserApproved = User::where('id',$user_id)->where('dev',1)->first();
        if($isUserApproved){
            return json_message(EXIT_FORM_NULL,"You're already a Developer!");
        }
        /**
         * if user had already an existing request with status = pending he cannot request another,
         * he must wait to declined it or approved it then he can make another reques to avoid spam!
         */
        
        $findExistingRequest = UserRequests::where('user_id',$user_id)->where('status','pending')->first();
        if($findExistingRequest){
            return json_message(EXIT_FORM_NULL,'You had already a pending request, Wait until the Admin Approved it or Decline it!');
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

    public function getRequestedData($id){
        if(empty($id) || $id === '0'){
            return json_message(EXIT_FORM_NULL,'No id found!');
        }

        $data = UserRequests::findOrFail($id);

        return $data;
       
    }
    public function approveRequest(Request $request){
        // Validate the request
        $request->validate([
            'user_id' => 'required|numeric',
            'request_id' => 'required|numeric',
        ]);
    
        try {
            // Find the user request
            $user_request = UserRequests::find($request->request_id);
            if (!$user_request) {
                return response()->json([
                    'status' => EXIT_FORM_NULL,
                    'message' => 'Request not found!',
                ], 404); // Return a 404 status code for not found
            }
    
            // Find the user
            $user = User::find($request->user_id);
            if (!$user) {
                return response()->json([
                    'status' => EXIT_FORM_NULL,
                    'message' => 'User not found!',
                ], 404); // Return a 404 status code for not found
            }
    
            // Use a database transaction to ensure atomicity
            DB::transaction(function () use ($user_request, $user) {
                // Update the request status to 'approved'
                $user_request->status = 'approved'; // Changed from 'pending' to 'approved'
                $user_request->save();
    
                // Update the user's dev status
                $user->dev = 1;
                $user->save();
            });
    
            // Return a success response
            return response()->json([
                'status' => EXIT_SUCCESS,
                'message' => 'Request approved successfully!',
            ], 200);
    
        } catch (\Throwable $th) {
            // Log the error for debugging
            be_logs('Failed to approve request', $th);
    
            // Return an error response
            return response()->json([
                'status' => EXIT_BE_ERROR,
                'message' => 'Failed to approve request. Please try again later.',
            ], 500); // Return a 500 status code for server errors
        }
    }

    public function declineRequest(Request $request){
        $request->validate([
            'user_id' => 'required|numeric',
            'request_id' => 'required|numeric'
        ]);

        try {
            $user_req = UserRequests::find($request->request_id);
            if(!$user_req){
                return json_message(EXIT_404,'Request not Found!');
            }

            $user_req->status = 'declined';
            $user_req->save();
            
            #success
            return json_message(EXIT_SUCCESS,'ok');
           
        } catch (\Throwable $th) {
            be_logs('Failed to declined user request',$th);
            return json_message(EXIT_BE_ERROR,'Failed to declined request');
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

    public function showAllRequest(){
        
        return DB::table('user_requests as r')
            ->join('users as u', 'r.user_id', '=', 'u.id')
            ->selectRaw('u.id, r.id as request_id, u.name, r.message, r.status, DATE_FORMAT(r.created_at, "%M %e, %Y, %h:%i %p") as date_created')
            ->orderByRaw("CASE WHEN r.status = 'pending' THEN 1 ELSE 2 END") // Prioritize pending status
            ->orderBy('r.created_at', 'DESC') // Then sort by created_at in DESC order
            ->get();
    }
}
