<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'text-yellow-800 bg-yellow-100',
            self::APPROVED => 'text-green-800 bg-green-100',
            self::REJECTED => 'text-red-800 bg-red-100',
            self::COMPLETED => 'text-green-800 bg-green-100',
            self::CANCELLED => 'text-orange-800 bg-orange-100',
        };
    }
}
