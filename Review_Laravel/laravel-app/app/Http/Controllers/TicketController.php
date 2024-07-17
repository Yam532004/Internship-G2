<?php 
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\TicketService;
use App\Services\DiscountPromotion;
use App\Services\FreeGiftPromotion;
use Illuminate\Http\Request;

class TicketController extends Controller{
    public function promote(Request $request, Ticket $ticket){
        $discountStrategy = new DiscountPromotion();
        $freeGiftStrategy = new FreeGiftPromotion();
        $ticketService = new TicketService($freeGiftStrategy);
        $ticketService->promote();

        return response()->json(['message' => 'Ticket promoted successfully!']);
    }
}

?>