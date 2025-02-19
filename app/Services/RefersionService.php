<?php

namespace App\Services;

use App\Enums\ConversionStatusEnum;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class RefersionService
{
    public function getAffiliates(int $page): array
    {
        $response = Http::refersion()->post("affiliate/list", [
            "limit" => "100",
            "page" => $page,
        ]);

        return $response->json();
    }

    public function getTotals(int $offerId, int $affiliateId): array
    {
        $response = Http::refersion()->post("conversion/totals", [
            "created_from" => "2000-01-01 00:00:00",
            "created_to" => Carbon::now()->endOfDay()->format('Y-m-d H:i:s'),
            "offer_id" => $offerId,
            "affiliate_id" => $affiliateId,
            "status" => collect(ConversionStatusEnum::cases())->pluck('value')->all(),
            "payment_status" => "UNPAID",
            "type" => [
                "AFFILIATE_SITE_CONVERSION",
                "MANUAL_CREDIT_BY_CLIENT",
                "CONVERSION_TRIGGER_SKU",
                "CONVERSION_TRIGGER_COUPON",
                "CONVERSION_TRIGGER_EMAIL",
                "AUTO_CREDIT_AFFILIATE_ID",
                "CANCELLATION_AFFILIATE_SITE_CONVERSION",
                "CANCELLATION_MANUAL_CREDIT_BY_CLIENT",
                "CANCELLATION_CONVERSION_TRIGGER_SKU",
                "CANCELLATION_CONVERSION_TRIGGER_COUPON",
                "CANCELLATION_CONVERSION_TRIGGER_EMAIL",
                "CANCELLATION_AUTO_CREDIT_AFFILIATE_ID"
            ]
        ]);

        return $response->json();
    }
}
