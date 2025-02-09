<?php

namespace App\Services;

use App\Models\Notifications;
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
                ->select('id','title','message','status','created_at')
                ->orderBy('created_at','DESC')         
                ->get();

        return $query;
    }

    public function updateNotification($id){
        $update = Notifications::where('id',$id)
            ->update(['status'=>'read']);
        if(!$update){
            return false;
        }
        return true;
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