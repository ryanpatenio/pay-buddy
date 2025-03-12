<?php

namespace App\Http\Controllers;

use App\Models\currency;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CurrenciesController extends Controller
{
    
    public function index_admin(){

        return view('admin.currencies.index');
    }

    public function create(Request $request){

        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:currencies,code',
            'name' => 'required|string|max:255|unique:currencies,name',
            'symbol' => 'required|string|unique:currencies,symbol',
            'img_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
             // Store the uploaded file with a unique name
            $file = $request->file('img_url');
            $filename = 'img/currencies/' . Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public', $filename);
        
            $insert = currency::create([
                'code' => $validatedData['code'],
                'name' => $validatedData['name'],
                'symbol' => $validatedData['symbol'],
                'img_url' =>$filename
            ]);

            if(!$insert){
                return json_message(EXIT_BE_ERROR,'Failed to create new currency');
            }

            return json_message(EXIT_SUCCESS,'ok');

        } catch (\Throwable $th) {
            handleException($th,'Failed to create new Currency');
            return json_message(EXIT_BE_ERROR,'Failed to create new Currency');
        }    
    }
}
