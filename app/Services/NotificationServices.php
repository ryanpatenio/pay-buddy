<?php

namespace App\Services;

use App\Models\Notifications;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationServices{
    /**
     * Create Nofitications
     * 
     * @param array $requestData
     * @return true ? sucess : false
     * @return Exception
     */

    public function createNotifications(array $requestData){

        $this->validateData($requestData);

        try {

            $insert =   Notifications::create([
                'user_id'=>$requestData['user_id'],
                'title'  => $requestData['title'],
                'message' => $requestData['message'],
                'status'  => 'unread'
           ]);

            if(!$insert){
                be_logs('failed to Create Notifications : '); #logs Error
                return false;
            }
            return true;#return true
            
        } catch (\Throwable $th) {
            be_logs('Creating Notification Error',$th);
            return false;
        }

    }

    public function showAllNotifications(){
        $query = DB::table('notifications')
                ->where('user_id',Auth::id())           
                ->select('id','title','message','status',DB::raw('DATE_FORMAT(created_at, "%M %e, %Y, %h:%i %p") as date_created'))
                ->orderBy('created_at','DESC')         
                ->get();

        return $query;
    }
    public function countUnreadNotifications(){
        return Notifications::where('user_id',Auth::id())
                ->where('status','unread')
                ->count();
    }

    public function updateNotification($id){
        $update = Notifications::where('id',$id)
            ->update(['status'=>'read']);
        if(!$update){
            return false;
        }
        return true;
    }

    public function allNotifications(){

        $query = DB::table('notifications')
        ->where('user_id', Auth::id())
        ->where('status','unread')
        ->select('id', 'title', 'message', 'status', 'created_at') // Fetch raw created_at
        ->orderBy('created_at', 'DESC')
        ->get();

        $notifications = $query->map(function ($notification) {
            return [
                'id' => $notification->id,
                'title' => $notification->title,
                'message' => $notification->message,
                'status' => $notification->status,
                'date_created' => Carbon::parse($notification->created_at)->diffForHumans(), // Format here
            ];
        });

        return $notifications;
    }

    protected function validateData(array $data): void{
        if(empty($data['user_id'])){
            throw new Exception('User required');
        }
        if(empty($data['title'])){
            throw new Exception('Title required!');
        }
        if(empty($data['message'])){
            throw new Exception('Message Require!');
        }
       
    }
}