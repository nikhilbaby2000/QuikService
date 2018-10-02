<?php

namespace App\Models\Traits;

use App\Models\Payment;

trait Payable
{
    /**
     * Get the invoice payment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable', 'payable_type', 'payable_id', 'id');
    }
}
