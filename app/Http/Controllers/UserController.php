<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use App\Models\Wallets;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $walletService;

    public function __construct(WalletService $walletServices)
    {
        $this->walletService = $walletServices;
    }
    
    public function index(){
        $users = $this->showAllUsers();

        return view('admin.users.users',compact('users'));
    }

    public function showAllUsers(){

        return DB::table('users')
            ->selectRaw('name,id ,status,DATE_FORMAT(created_at, "%M %e, %Y, %h:%i %p") as date_created,
            case 
                when role =1 then "admin"
                when role = 0 then "user"
                end as role,
            Case
                when status = 0 then "active"
                when status = 1 then "deactivated"
                end as user_status
            ')

            ->where('id','!=',Auth::id())
            ->get();
    }
    public function getEmail($id){
       // Validate the ID
        if (!is_numeric($id) || empty($id)) {
            return json_message(EXIT_404, 'Invalid or missing ID!');
        }
        try {
           $user = User::where('id',$id)->firstOrFail();

           return json_message(EXIT_SUCCESS,'ok',$user->email);

        } catch (\Throwable $th) {
            //throw $th;
            handleException($th,'Failed to fetch email');
            return json_message(EXIT_BE_ERROR,'Failed to fetch email');
        }
    }
    public function updateEmail(Request $request){
        $request->validate([
            'user_email' => 'bail|sometimes|required|string|email|unique:users,email,' . $request->id,
            'id'    => 'bail|required|numeric|exists:users,id',
        ]);

        try {
            $user = User::find($request->id);
           
            $user->email = $request->user_email;
            $user->save();

            return json_message(EXIT_SUCCESS,'ok');
        } catch (\Throwable $th) {
           handleException($th,'failed to update email');
           return json_message(EXIT_BE_ERROR,'failed to update email');
        }
    }
    public function updatePassword(Request $request){
        $request->validate([
            'current_password'=> 'bail|required|string|max:255',
            'newPassword'     => 'bail|required|string|min:8|max:255',
            'id'              => 'bail|required|numeric|exists:users,id'

        ],[
            'id.numeric'=>'Unexpected Error ID must be a Integer Instead of String!',
            'id.required'=> 'Invalid or missing ID',
            'id.exists'  => 'Invalid or missing ID'
        ]);
       
        $user = User::find($request->id);
        if(!Hash::check($request->current_password,$user->password)){
            return response()->json([
                'codeStatus'  => EXIT_FORM_NULL,
                'message' => 'Invalid current password',
            ], 401); // 401 is the HTTP status code for unauthorized
        }

        try {
            $user->password = Hash::make($request->newPassword);
            $user->save();

            return json_message(EXIT_SUCCESS,'ok');
        } catch (\Throwable $th) {
           handleException($th,'Failed to updated Password');
           return json_message(EXIT_BE_ERROR,'Failed to updated Password');
        }
    }

    public function createUser(Request $request){

        // Validate the request data
        $validator = validator($request->all(), [
            'email' => 'required|string|email|max:255|unique:users,email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,user' // Ensure role is either 'admin' or 'user'
        ]);
        if($validator->fails()){
            return json_message(EXIT_FORM_NULL,'validation error',$validator->errors());
        }
         // Get the validated data
        $data = $validator->validated();    
        // Determine the user role based on the input
        $user_role = $data['role'] === 'admin' ? 1 : 0;

        try {
            DB::transaction(function () use($data,$user_role){
               $user = User::create([
                    'name'=>$data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'role'    => $user_role
                ]);

                UserDetails::create([
                    'user_id' => $user->id
                ]);

                $accountNumber = $this->walletService->generateUniqueAccountNumber();
                Wallets::create([
                    'user_id' => $user->id,
                    'currency_id' => 1,#w/c is PHP
                     'account_number' => $accountNumber,
                     'balance' => 0
                ]);
            });
          
            return json_message(EXIT_SUCCESS,'ok');
        } catch (\Throwable $th) {
            be_logs('Failed to create new User',$th);
            return json_message(EXIT_BE_ERROR,'failed to create new user');
        }

    }
    

    public function showUserDetails($id){
        if(!$id || empty($id)){
            return json_message(EXIT_404,'ID not found!');
        }

        $data = DB::table('user_details as ud')
            ->join('users as u','ud.user_id','=','u.id')
            ->where('u.id',$id)
            ->select(
                'u.name',
                'u.email',
                'ud.province',
                'ud.city',
                'ud.brgy',
                'ud.zip_code',
                'ud.country',
                'ud.phone_number',
                'ud.overview'
                )
                ->first();
        if(empty($data) || !$data){
            return json_message(EXIT_BE_ERROR,'failed to fetch Data');
        }
        return $data;
    }

    public function updateUserDetails(Request $request){
        $messages = [
            'name.required' => 'The name field is required.',
            'phone_number.regex' => 'The phone number must be a valid number.',
            'zip_code.regex' => 'The zip code must be exactly 4 digits.',
        ];
    
        $request->validate([
            'name'        => 'bail|required|string|max:255',
            'phone_number'=> 'bail|required|string|min:8|regex:/^\+?[0-9]+$/',
            'country'     => 'bail|required|string|max:255',
            'city'        => 'bail|required|string|max:255',
            'brgy'        => 'bail|required|string|max:255',
            'province'    => 'bail|required|string|max:255',
            'zip_code'    => 'bail|required|string|regex:/^[0-9]{4}$/',
            'overview'    => 'bail|required|string|max:255',
            'id'          => 'bail|required|numeric|exists:users,id',
        ], $messages);

        try {
            DB::transaction(function () use ($request) {
                $user = User::findOrFail($request->id);
                $user->update(['name' => $request->name]);
    
                $user_details = UserDetails::firstOrNew(['user_id' => $request->id]);
                $user_details->fill([
                    'province'     => $request->province,
                    'city'         => $request->city,
                    'brgy'         => $request->brgy,
                    'zip_code'     => $request->zip_code,
                    'country'      => $request->country,
                    'phone_number' => $request->phone_number,
                    'overview'     => $request->overview,
                ])->save();
            });

            return json_message(EXIT_SUCCESS, 'User details updated successfully!');

        } catch (\Throwable $th) {
            handleException($th,'failed to update user details!');
            return json_message(EXIT_BE_ERROR,'failed to update user details!');
        }
      
    }

    public function userStatus($id){
        if(!is_numeric($id) || empty($id)){
            return json_message(EXIT_404,'Invalid or missing ID');
        }
        $user = User::find($id);
        if(!$user){
            return json_message(EXIT_404,'Invalid or missing ID');
        }
        $status = $user->status;
        return json_message(EXIT_SUCCESS,'ok',$status);

    }

    public function deactivateUser(Request $request){
        $request->validate([
            'confirmDeactivate'=>'required',
            'id'    => 'required|numeric|exists:users,id'        
        ],[
            'id.numeric'=>'Invalid or missing ID',
            'id.exists' => 'Invalid or Missing ID',
            'confirmDeactivate.required'=> 'Confirm Checkbox required!'
        ]);#return status 422

        $user = User::find($request->id);
        try {
            $user->status = 1; #means deactivated
            $user->save();

            return json_message(EXIT_SUCCESS,'ok');

        } catch (\Throwable $th) {
            handleException($th,'Failed to Delete Account!');
            return json_message(EXIT_BE_ERROR,'Failed to Delete Account');
            #return status 500
        }

    }
    public function activateUser(Request $request){
        $request->validate([
            'id'=>'required|numeric|exists:users,id',
        
         ],[
            'id.required' => 'Invalid or Missing ID',
            'id.numeric'  => 'ID expects Integer instead of String',
            'id.exists'    => 'Invalid or Missing ID'
         ]
        );#return status 422

        try {
            $user = User::find($request->id);

            $user->status = 0;#active
            $user->save();

            return json_message(EXIT_SUCCESS,'ok');

        } catch (\Throwable $th) {
            handleException($th,'Failed to activate user');
            return json_message(EXIT_BE_ERROR,'failed to activate user');
        }

        
    }
    public function setUserStatus(Request $request){
        $request->validate([
            'id' => 'required|numeric|exists:users,id',
            'status' => 'required|string|in:enable,disable'
        ],[
            'id.required' => 'Invalid or missing ID',
            'id.numeric' => 'ID expects Numeric instead of String',
            'id.exists' => 'Invalid or missing ID',
            'status.in' => 'Status must be either "enable" or "disable"',
        ]
        );
        $status = $request->status === "enable" ? STATUS_ENABLED : STATUS_DISABLED;
    
        try {
           $user = User::find($request->id);

           $user->status = $status;
           $user->save();

           return json_message(EXIT_SUCCESS,'ok');

        } catch (\Throwable $th) {
            handleException($th,'Failed to '.$status.' User');
            return json_message(EXIT_BE_ERROR,'failed to '.$status.' User account');
        }
    }
}
