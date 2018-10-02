<?php

namespace App\Models\Traits;

trait HasPendingApproval
{
    /**
     * Scope a query to add the approved condition.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('approved', 1);
    }

    /**
     * Scope a query to add the unapproved condition.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnapproved($query)
    {
        return $query->where('approved', -1);
    }

    /**
     * Scope a query to add the pending approval condition.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePendingApproval($query)
    {
        return $query->where('approved', 0);
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
