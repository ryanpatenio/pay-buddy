<?php

namespace App\Http\Controllers;

use App\Models\api_logs;
use App\Models\User;
use App\Services\ApiLogsServices;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogsController extends Controller
{

    private $ApiLogsService;
    public function __construct(ApiLogsServices $logsServices)
    {
        $this->ApiLogsService = $logsServices;
    }

   public function index_admin(){
    $logs = $this->ApiLogsService->showAllLogs();
    
     return view('admin.UsersApiLogs.index',compact('logs'));
   }

   public function userLogs($id){
        $users = User::findOrFail($id);

        $logs  = $this->ApiLogsService->showUserApiLogs($id);
       
        return view('admin.UsersApiLogs.viewUserLogs',compact('users','logs'));
   }

   public function getLogs($id){
    try {
        $logs = api_logs::findOrFail($id);

        // Format the created_at date using Carbon
        $logs->created_at = Carbon::parse($logs->created_at)->format('F j, Y g:i A');
        
        return json_message(EXIT_SUCCESS,'ok',$logs);
    } catch (\Throwable $th) {
        handleException($th,'Failed to fetch user logs');
        return json_message(EXIT_BE_ERROR,'Failed to fetch User APi Logs');
    }
   }
}
