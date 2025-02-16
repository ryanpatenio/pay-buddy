<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use App\Services\NotificationServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;

class NotificationController extends Controller
{
    private $notificationService;

    public function __construct(NotificationServices $notificationServices) 
    {
        $this->notificationService = $notificationServices;
    }

    public function notif_index(){
        $notifications = $this->notificationService->showAllNotifications();

        return view('users.notifications.index',compact('notifications'));
    }

    public function getNotification($id){

      if(! is_numeric($id)){
        return json_message(EXIT_FORM_NULL,'Invalid ID');
      }
        $notif = Notifications::findOrFail($id);
        $notif->date_created = Carbon::parse($notif->date_created)->format('F j, Y, h:i A');

        return json_message(EXIT_SUCCESS,'ok',$notif);
    }

    public function update(Request $request){
        $data = $request->validate([
            'id'=>'required|numeric'
        ]);

        try {
            $notif = Notifications::where('id',$data['id'])->firstOrFail();
            $notif->update(['status'=>'read']);
            
            if(!$notif){
                return json_message(EXIT_BE_ERROR,'failed to update',$notif);
            }
            return json_message(EXIT_SUCCESS,'ok');

        } catch (\Throwable $th) {
            be_logs('Failed to update Notification to read',$th);
        }
    }

    public function notificationsCount(){

        try {
            $count = $this->notificationService->countUnreadNotifications();

           return json_message(EXIT_SUCCESS,'ok',$count);
        } catch (\Throwable $th) {
           handleException($th,'failed to fetch Notificaitions count!');
           return json_message(EXIT_BE_ERROR,'failed to fetch Notificaitions count!');
        }
    }

    public function allNotifications(){
        try {
           $data = $this->notificationService->allNotifications();
           return json_message(EXIT_SUCCESS,'ok',$data);

        } catch (\Throwable $th) {
            handleException($th,'failed to fetch Notificaitions !');
           return json_message(EXIT_BE_ERROR,'failed to fetch Notificaitions !');
        }
    }
}
