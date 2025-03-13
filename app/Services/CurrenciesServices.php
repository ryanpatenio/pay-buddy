<?php

namespace App\Services;

use App\Models\currency;

class CurrenciesServices{

    /**
     * Return all Currencies
     * @return array
     * 
     */
    public function showAllCurrencies(){
        $result = currency::all();

        return $result;
    }

}

?>