<?php

namespace App\Models\Traits;

use App\Models\Invoice as BaseInvoice;

trait HasBaseInvoice
{
    /**
     * The base invoice that the invoice belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function baseInvoice()
    {
        return $this->belongsTo(BaseInvoice::class, 'invoice_id', 'id');
    }

    /**
     * Generate the base invoice model and associate.
     * If the base invoice already exists then ignore.
     *
     * @return BaseInvoice|null
     */
    public function makeBaseInvoice()
    {
        if ($this->baseInvoice()->exists()) {
            return null;
        }

        $baseInvoice = BaseInvoice::create(['invoice_date' => now()]);

        $this->baseInvoice()->associate($baseInvoice)->save();

        return $baseInvoice;
    }
}
