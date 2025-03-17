<?php

namespace App\Http\Controllers;

use App\Models\currency;
use App\Models\Fees;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FeesController extends Controller
{
   public function index_admin(){
    $Fees = $this->showAllFees();
    return view('admin.fees.index',compact('Fees'));
   }

   public function addFee(Request $r){
    
        $validatedData = $r->validate([
            'transaction_type' => 'required|string|in:send_money,external_api',
            'currency' => 'required|string|regex:/^[A-Z]{3}$/',
            'amount' => 'required|numeric|min:0.1'

        ]);
        $isExist = $this->isCurrencyExists($validatedData['currency']);
        if($isExist){
            return json_message(EXIT_401,'Fee is already exist!');
        }

        try {
           $create = Fees::create([
                'transaction_type'=> $validatedData['transaction_type'],
                'currency' => $validatedData['currency'],
                'amount'   => $validatedData['amount']
           ]);
           if(!$create){
            return json_message(EXIT_BE_ERROR,'Failed to create new Fee');
           }

           return json_message(EXIT_SUCCESS,'ok');

        } catch (\Throwable $th) {
            handleException($th,'Failed to create new Fee');
            return json_message(EXIT_BE_ERROR,'Failed to create new Fee');
        }

   }

   public function updateFee(Request $r){
    $fee = Fees::find($r->id);
    if(!$fee){
        return json_message(EXIT_401, 'Invalid Id or No data found!');
    }

    $validatedData = $r->validate([
        'id' => 'required|numeric',
        'transaction_type' => [
            'required',
            'string',
            'in:send_money,external_api',
            Rule::unique('fees')->where(function ($query) use ($r) {
                return $query->where('transaction_type', $r->transaction_type)
                             ->where('currency', $r->currency);
            })->ignore($fee->id), // Ignore the current fee being updated
        ],
        'currency' => [
            'required',
            'string',
            'regex:/^[A-Z]{3}$/',
            Rule::unique('fees')->where(function ($query) use ($r) {
                return $query->where('transaction_type', $r->transaction_type)
                             ->where('currency', $r->currency);
            })->ignore($fee->id), // Ignore the current fee being updated
        ],
        'amount' => 'required|numeric|min:0.1'
    ]);
    try {
        
        $fee->update($validatedData);
        return json_message(EXIT_SUCCESS, 'Fee updated successfully!');

    } catch (\Throwable $th) {
       handleException($th,'Failed to update Fee');
       return json_message(EXIT_BE_ERROR,'Failed to update Fee');
    }

   
}

   public function getFee($id){
    if(empty($id) || !is_numeric($id)){
        return json_message(EXIT_FORM_NULL,'Invalid Id');
    }
    $fee = Fees::find($id);
    if(!$fee){
        return json_message(EXIT_BE_ERROR,'Failed to fetch Fee');
    }
    return json_message(EXIT_SUCCESS,'ok',$fee);
   }

   public function currencies() : object{
        $query = currency::all();
        return $query;
   }
   public function showAllFees() :object{
        $fees = Fees::orderBy('currency', 'asc')->orderBy('amount', 'asc')->get();

        return $fees;
   }

   private function isCurrencyExists(string $currency): bool{
    $transactionTypes = ['send_money', 'external_api'];

    return Fees::whereIn('transaction_type', $transactionTypes)
               ->where('currency', $currency)
               ->exists();
    }

    private function isCurrencyExistsInUpdate(string $currency, int $id) : object {
        $transactionTypes = ['send_money', 'external_api'];

        return Fees::whereIn('transaction_type',$transactionTypes)
                    ->where('currency', $currency)
                    ->where('id','!=',$id)                   
                    ->get();
    }
}
