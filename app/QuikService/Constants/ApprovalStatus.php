<?php

namespace App\QuikService\Constants\Status;

class ApprovalStatus
{
    const PENDING   = 'pending';
    const APPROVED  = 'approved';
    const DECLINED  = 'declined';
    const CANCELLED = 'cancelled';
    const EXPIRED   = 'expired';

    /**
     * Get all approval status.
     *
     * @return array
     */
    public static function all()
    {
        return [
            self::PENDING,
            self::APPROVED,
            self::DECLINED,
            self::CANCELLED,
            self::EXPIRED,
        ];
    }
}
