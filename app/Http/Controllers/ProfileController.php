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

class ProfileController extends Controller
{
    private $walletService;

    public function __construct(WalletService $walletServices)
    {
        $this->walletService = $walletServices;
    }
    public function index(){
        $profile = $this->show();
        $availableCurrencies = $this->walletService->availableCurrencyByUser();
        $allWallets = $this->showAllWallets();

        return view('users.profile.profile',compact('profile','availableCurrencies','allWallets'));
    }

    public function show(){

        return  DB::table('user_details as ud')
            ->join('users as u','ud.user_id','=','u.id')
            ->where('u.id',Auth::id())
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
    }

    // public function test(Request $request){

    //     return json_message(EXIT_SUCCESS,'ok',$request->all());
    // }

    public function updateBasicInfo(Request $request){
         $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'phone_number'     => 'sometimes|required|string',

            'country'     => 'sometimes|required|string',
            'city'      => 'sometimes|required|string',
            'province'  => 'sometimes|required|string',
                
            'brgy'      => 'sometimes|required|string',
            'zip_code'  => 'sometimes|required|string',  
            'overview'  => 'sometimes|required|string',
            
        ]);
        $user_id = Auth::id();

            try {
                
                $update =  DB::transaction(function () use ($request,$user_id) {

                $user = User::findOrFail($user_id);
                $userDetails = UserDetails::findOrFail($user_id);

                $userFieldToUpdate = $request->only(['name']);

                $userDetailsFieldToUpdate = $request->only([
                    'province',
                    'city',
                    'brgy',
                    'zip_code',
                    'country',
                    'phone_number',
                    'overview'
                ]);
                $user->fill($userFieldToUpdate);
                $userDetails->fill($userDetailsFieldToUpdate);

                $userDetails->save();
                $user->save();

                return true;

            });

            if(!$update){
                return json_message(EXIT_BE_ERROR,'failed to Update!',$update);
            }

            return json_message(EXIT_SUCCESS,'ok');


            } catch (\Throwable $th) {
                be_logs('Failed to update Profile',$th);
                \Log::error('Registration failed', ['error' => $th->getMessage()]);
            }
           
    }

    public function getEmail(){

        return User::where('id', Auth::id())
            ->select('email', 'name', 
                DB::raw("CASE 
                    WHEN role = 0 THEN 'User'
                    WHEN role = 1 THEN 'Admin'
                    WHEN role = 2 THEN 'Super Admin' 
                END AS role")
            )->first();

    }

    public function updateEmail(Request $request)
    {
        $validator = validator($request->all(), [
            'user_email' => 'sometimes|required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);
    
        if ($validator->fails()) {
            return json_message(EXIT_FORM_NULL, 'Validation error',$validator->errors());
        }
    
        try {
            $validatedData = $validator->validated(); // Get validated data
    
            $update = User::where('id', Auth::id())->firstOrFail(); // Find the user by ID
            $update->email = $validatedData['user_email']; // Update email
            $update->save(); // Save changes
    
            return json_message(EXIT_SUCCESS, 'Email updated successfully.');
    
        } catch (\Throwable $th) {
            be_logs('Error updating Email', $th);
            return json_message(EXIT_BE_ERROR, 'Something went wrong.');
        }
    }

    public function updatePassword(Request $request){
        $validator = validator($request->all(),[
            'current_password' => 'required|string|min:8',
            'newPassword'      => 'required|string|min:8',
            
        ]);
        if($validator->fails()){
            return json_message(EXIT_FORM_NULL, 'Validation error',$validator->errors());
        }

        $validatedData = $validator->validated();
        $user = Auth::user();

        // Check if the current password is correct
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return response()->json([
                'codeStatus'  => EXIT_FORM_NULL,
                'message' => 'Invalid current password',
            ], 401); // 401 is the HTTP status code for unauthorized
        }
         // Hash the new password and update the user's password
        $user->password = Hash::make($validatedData['newPassword']);
        $user->save();

        return json_message(EXIT_SUCCESS,'ok');
    }

    public function addNewWallet(Request $request){
        $validator = validator($request->all(),[
            'currency' => 'required|integer'

        ]);
        if($validator->fails()){
            return json_message(EXIT_FORM_NULL,'validatons error',$validator->errors());
        }
        
        try {
            $user_id = Auth::id();
            $currency = $validator->validated();
            $findcurrency = Wallets::where('currency_id',$currency['currency'])->where('user_id',$user_id)->first();

            if(!empty($findcurrency)){
                return json_message(EXIT_FORM_NULL,'Wallet already existed!');
            }
            #create new wallet
            $data = [
                'user_id'=> $user_id,
                'currency_id'=>$currency['currency'],
                'account_number'=> $this->walletService->generateUniqueAccountNumber(),
                'balance'    => 0
            ];
    
            $create = Wallets::create($data);
            if(!$create){
                return json_message(EXIT_BE_ERROR,'failed to Create wallet1');
            }
            return json_message(EXIT_SUCCESS,'ok');

        } catch (\Throwable $th) {
            be_logs('failed to create new wallet',$th);
            return json_message(EXIT_BE_ERROR,'Failed to create new Wallet2');
        }


    }
    private function showAllWallets(){
        return DB::table('wallets as w')
            ->join('currencies as c','w.currency_id','=','c.id')
            ->where('w.user_id',Auth::id())
            ->select('w.id as wallet_id','c.name','c.img_url','w.account_number')
            ->get();
    }
    
    public function deactivateAccount(Request $request){
       

       $confirm = $request->has('confirmDeactivate');
       if(!$confirm){
            return json_message(EXIT_FORM_NULL,'Plese check the check box!');
       }
       
        try {
            $user = Auth::user();

            $user->status = 1;
            $user->save();

            // Log the user out
            Auth::logout();

            // Invalidate the session to clear all session data
            $request->session()->invalidate();
    
            // Regenerate the CSRF token to prevent CSRF attacks
            $request->session()->regenerateToken();
    
            // Clear the 'remember' cookies if they exist
            cookie()->queue(cookie()->forget('email'));
            cookie()->queue(cookie()->forget('remember'));
    
            // Redirect the user to the login page
            return redirect()->route('login');


        } catch (\Throwable $th) {
            be_logs('failed to delete account',$th);
                return response()->json([
                    'status'  => EXIT_BE_ERROR,
                    'message' => 'Failed to delete account',
                    'error'   => $th->getMessage(),
                ], 500);
        }

    }


}
