<?php
namespace App\Services;

use App\Contracts\IPromoteStrategy;

class FreeGiftPromotion implements IPromoteStrategy{
    public function promote(){
        echo "Apply free gift promotion";
    }
}
?>