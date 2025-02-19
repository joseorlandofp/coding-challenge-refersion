<?php

namespace App\Enums;

enum ConversionStatusEnum : string
{
    case APPROVED = "APPROVED";
    case PENDING = "PENDING";
    case UNQUALIFIED = "UNQUALIFIED";
    case DENIED = "DENIED";
}
