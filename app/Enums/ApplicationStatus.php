<?php

namespace App\Enums;

enum ApplicationStatus: string
{
    case NEW = 'NEW';
    case PROCESSING = 'PROCESSING';
    case APPROVED = 'APPROVED';
    case DECLINED = 'DECLINED';
    case COMPLETED = 'COMPLETED';
    case CANCELLED = 'CANCELLED';

    public function readableText(): string
    {
        return match ($this) {
            ApplicationStatus::NEW => 'New',
            ApplicationStatus::PROCESSING => 'Processing',
            ApplicationStatus::APPROVED => 'Approved',
            ApplicationStatus::DECLINED => 'Declined',
            ApplicationStatus::COMPLETED => 'Completed',
            ApplicationStatus::CANCELLED => 'Cancelled',
        };
    }
}
