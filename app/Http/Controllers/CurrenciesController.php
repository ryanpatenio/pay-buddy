<?php

namespace App\Http\Controllers;

use App\Models\currency;
use App\Services\CurrenciesServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CurrenciesController extends Controller
{   
    private $currenciesService;
    public function __construct(CurrenciesServices $currenciesServices)
    {
        $this->currenciesService = $currenciesServices;
    }
    
    public function index_admin(){
        $Currencies = $this->currenciesService->showAllCurrencies();
        
        return view('admin.currencies.index',compact('Currencies'));
    }

    public function create(Request $request){

        $validatedData = $request->validate([
            'code' => 'required|string|max:3|unique:currencies,code',
            'name' => 'required|string|max:255|unique:currencies,name',
            'symbol' => 'required|string|unique:currencies,symbol',
            'img_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            //Store the uploaded file with a unique name
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

    public function getCurrency($hidden_id){
        if(empty($hidden_id)){
            return json_message(EXIT_FORM_NULL,'hidden_id is required');
        }
        try {
            $currency = currency::findOrFail($hidden_id);
            return $currency;
        } catch (\Throwable $th) {
             handleException($th,'Failed to fetch Currency');
             return json_message(EXIT_BE_ERROR,'Failed to fetch Currency');
        }

    }

    public function updateCurrency(Request $request){

        $validatedData = $request->validate([
            'hidden_id'=> 'required|numeric',
            'name' => 'required|string|max:255|unique:currencies,name,'.$request->hidden_id,
            'code' => 'required|string|max:3|unique:currencies,code,'.$request->hidden_id,
            'symbol' => 'required|string|max:255|unique:currencies,symbol,'.$request->hidden_id
        ]);

        try {
            $currency = currency::findOrFail($validatedData['hidden_id']);
            
            $currency->update([
                'name' => $validatedData['name'],
                'code' => $validatedData['code'],
                'symbol' => $validatedData['symbol']
            ]);
 
            return json_message(EXIT_SUCCESS,'ok'); //return success
        } catch (\Throwable $th) {
           handleException($th,'Failed to update Currency');
           return json_message(EXIT_BE_ERROR,'Failed to update Currency');
        }

    }

    public function updateImage(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|numeric|exists:currencies,id',
            'new_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $currency = currency::findOrFail($validatedData['id']);

             # Delete the old image if it exists
            if ($currency->img_url) {
                Storage::disk('public')->delete($currency->img_url);
            }

            $file = $request->file('new_img');
            $filename = 'img/currencies/' . Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public', $filename);

            $currency->update([
                'img_url' => $filename
            ]);

            return json_message(EXIT_SUCCESS,'ok');

        } catch (\Throwable $th) {
            handleException($th,'Failed to update Currency Image');
            return json_message(EXIT_BE_ERROR,'Failed to update Currency Image');
        }

    }

}
