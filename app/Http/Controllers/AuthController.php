<?php

namespace App\Http\Controllers;

use App\Models\currency;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\Wallets;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function login(Request $request) {
        // Validate the request data
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        // Get credentials from the request
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
    
        try {
            //condition to check if the user's status is 0 (active)
            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'status' => 0], $remember)) {
                $user = Auth::user();
    
                // Set remember me cookies if "remember" is checked
                if ($remember) {
                    cookie()->queue('email', $request->email, 1440); // 1440 minutes = 1 day
                    cookie()->queue('remember', true, 1440);
                } else {
                    // Clear remember me cookies if "remember" is not checked
                    cookie()->queue(cookie()->forget('email'));
                    cookie()->queue(cookie()->forget('remember'));
                }
    
                // Redirect based on user role
                return match ($user->role) {
                    2 => redirect()->intended('/Dashboard-admin')->with('success', 'Welcome, Super Admin!'),
                    1 => redirect()->intended('/Dashboard-admin')->with('success', 'Welcome, Admin!'),
                    0 => redirect()->intended('user-dashboard')->with('success', 'Welcome, Investor!'),
                    default => redirect()->intended('user-dashboard')->with('success', 'Welcome, User!'),
                };
            }
    
            // If authentication fails, check if the user exists and is deactivated
            $user = User::where('email', $credentials['email'])->first();
    
            if ($user && $user->status == 1) {
                // If the user exists but is deactivated (status = 1)
                return redirect()->back()->withInput()->with('error', 'Your account has been deactivated. Please contact support.');
            }
    
        } catch (\Throwable $th) {
            // Log the exception and return an error message
            \Log::error('Login error: ' . $th->getMessage());
            return back()->with('error', 'Invalid credentials.');
        }
    
        // If the credentials are invalid or the account is not found
        return back()->with('error', 'Invalid credentials.');
    }
    

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            
        ]);
           
        try {

            DB::transaction(function () use ($request) {
                // Create the user
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                
                ]);
                UserDetails::create([
                    'user_id'=> $user->id
                ]);

                $currency = currency::where('code','PHP')->value('id');
              
                
                // Auto-login the user
                Auth::login($user);
                $accountNumber = $this->walletService->generateUniqueAccountNumber();
    
                // Add other initialization (e.g., create wallets)
                Wallets::create([
                    'user_id' => $user->id,
                    'currency_id' => $currency,//which mean PHP or PESO DEFAULT
                    'account_number'=> $accountNumber ,
                    'balance' => 0.00, // Default starting balance
                ]);
            });
            
            return redirect()->route('user.dashboard')->with('success', 'Registration successful.');

        } catch (\Exception $e) {
            // Log error and redirect back with an error message
            \Log::error('Registration failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }
    }

   public function logout(Request $request){

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
   }

   public function user()
   {
       // Retrieve the currently authenticated user's ID
       $user = DB::table('users')
           ->where('id', Auth::id()) // Use Auth::id() correctly
           ->select('name', 'email') // Use select() to fetch specific columns
           ->first(); // Use first() instead of get() to fetch a single record
   
       // Check if a user record is found
       if ($user) {
           return $this->json_message(EXIT_SUCCESS, 'ok', $user);
       }
   
       // If no user record is found, return an error response
       return $this->json_message(EXIT_BE_ERROR, 'error');
   }

   


}
