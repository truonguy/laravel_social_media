<?php
namespace App\Http\Enums;
enum GroupUserStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
}
