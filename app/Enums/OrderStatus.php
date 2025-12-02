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
            self::PENDING => 'text-yellow-600 bg-yellow-100',
            self::APPROVED => 'text-blue-600 bg-blue-100',
            self::REJECTED => 'text-red-600 bg-red-100',
            self::COMPLETED => 'text-green-600 bg-green-100',
            self::CANCELLED => 'text-gray-600 bg-gray-100',
        };
    }
}
