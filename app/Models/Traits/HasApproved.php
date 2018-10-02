<?php

namespace App\Models\Traits;

trait HasApproved
{
    /**
     * Scope a query to add the approved condition.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    /**
     * Scope a query to add the unapproved condition.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnapproved($query)
    {
        return $query->where('approved', false);
    }

    /**
     * Check if approved.
     *
     * @return bool
     */
    public function isApproved()
    {
        return (bool) $this->approved;
    }
}
