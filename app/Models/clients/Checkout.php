<?php
namespace App\Models\clients;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblCheckout;

class Checkout extends Model
{
    public function createCheckout($data) {
        $checkout = TblCheckout::create($data);
        return $checkout->checkoutId;
    }
}
