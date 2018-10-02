<?php

namespace App\Models\Traits;

use App\QuikService\Constants\Status\ApprovalStatus;

trait HasApprovalStatus
{
    /**
     * Check if the request is pending.
     *
     * @return bool
     */
    public function isPendingApproval()
    {
        return $this->status === ApprovalStatus::PENDING;
    }

    /**
     * Check if the request is approved.
     *
     * @return bool
     */
    public function isApproved()
    {
        return $this->status === ApprovalStatus::APPROVED;
    }

    /**
     * Check if the request is declined.
     *
     * @return bool
     */
    public function isDeclined()
    {
        return $this->status === ApprovalStatus::DECLINED;
    }

    /**
     * Check if the request is cancelled.
     *
     * @return bool
     */
    public function isCancelled()
    {
        return $this->status === ApprovalStatus::CANCELLED;
    }

    /**
     * Check if the request is declined.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->status === ApprovalStatus::EXPIRED;
    }
}
