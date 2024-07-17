<?php
namespace App\Services;

use App\Contracts\IPromoteStrategy;

class DiscountPromotion implements IPromoteStrategy{
    public function promote(){
        echo "Apply discount promotion";
    }
}

?>