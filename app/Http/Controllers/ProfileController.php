<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $profile = $this->show();

        return view('users.profile.profile',compact('profile'));
    }

    public function show(){

        return  DB::table('user_details as ud')
            ->join('users as u','ud.user_id','=','u.id')
            ->select(
                'u.name',
                'u.email',
                'ud.address',
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

    public function updateBasicInfo(Request $request){
        $data = $request->validate([
            'id' => 'required|integer|exists:users,id',
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $request->id,
            'password' => 'sometimes|required|string|min:8',
            'address'   => 'sometimes|required|string',
            'province'  => 'sometimes|required|string',
            'city'      => 'sometimes|required|string',
            'brgy'      => 'sometimes|required|string',
            'zip_code'  => 'sometimes|required|string',
            'country'     => 'sometimes|required|string',
            'phone'     => 'sometimes|required|string',
            'overview'  => 'sometimes|required|string',
            'password'  => 'sometimes|required|string|min:8'
        ]);

            try {
                
                $user = User::findOrFail($data['id']);
                $userDetails = UserDetails::findOrFail($data['id']);

                $userFieldToUpdate = $request->only(['name','email','password']);
                if (isset($userFieldToUpdate['password'])) {
                    $fieldToUpdate['password'] = Hash::make($userFieldToUpdate['password']);
                }

                $userDetailsFieldToUpdate = $request->only([
                    'address',
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



            } catch (\Throwable $th) {
                //throw $th;
            }
           
    }


}
