<?php

namespace App\Enums;

enum ComplaintStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Resolved = 'resolved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Menunggu',
            self::InProgress => 'Diproses',
            self::Resolved => 'Selesai',
            self::Rejected => 'Ditolak',
        };
    }

    public function canTransitionTo(self $status): bool
    {
        return match ($this) {
            self::Pending => in_array($status, [self::InProgress, self::Rejected], true),
            self::InProgress => in_array($status, [self::Resolved, self::Rejected], true),
            self::Resolved, self::Rejected => false,
        };
    }
}
