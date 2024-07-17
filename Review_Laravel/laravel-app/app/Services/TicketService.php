<?php 
namespace App\Services;
use App\Contracts\IPromoteStrategy;

class TicketService{
    private $promotionStrategy;
    public function __construct(IPromoteStrategy $promotionStrategy){
        $this->promotionStrategy = $promotionStrategy;
    }
    public function setPromotionStrategy(IPromoteStrategy $promoteStratery){
        $this->promotionStrategy = $promoteStratery;
    }

    public function promote(){
        $this->promotionStrategy->promote();
    }

}
?>