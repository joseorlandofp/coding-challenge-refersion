<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AffiliateService
{
    private $refersionService;

    public function __construct(RefersionService $refersionService)
    {
        $this->refersionService = $refersionService;
    }

    public function all(): Collection
    {
        $affiliates = collect();
        $page = 1;

        do {

            $response = $this->refersionService->getAffiliates($page);
            if (isset($response['message'])) {
                throw new \Exception($response['message']);
            }

            if (!isset($response['page'], $response['results']) || !is_array($response['results'])) {
                throw new \Exception("Invalid API response.");
            }

            [$currentPage, $totalPages] = explode('/', $response['page']);

            $affiliates = $affiliates->merge($response['results']);
            $page++;
        } while ($page <= (int) $totalPages);

        return $affiliates;
    }

    public function leaderBoardAffiliates(Collection $affiliates): Collection
    {
        return $affiliates->filter(fn($affiliate) => collect($affiliate['custom_fields'] ?? [])
            ->contains(fn($field) => ($field['label'] ?? null) === "Display in leaderboard"
                && strtolower($field['value'] ?? '') === "true"));
    }

    public function getTotals(Collection $affiliates) : Collection
    {
        $affiliates->transform(function ($affiliate) {
            $affiliate['totals'] = $this->refersionService->getTotals($affiliate['offer_id'], $affiliate['id']);
            return $affiliate;
        });

        return $affiliates;
    }

    public function topFive() : Collection
    {
        $affiliates = $this->all();
        $leaderBoardAffiliates = $this->leaderBoardAffiliates($affiliates);
        $affiliatesWithTotals = $this->getTotals($leaderBoardAffiliates);

        return $affiliatesWithTotals->sortByDesc(fn($affiliate) => $affiliate['totals']['commission_total'] ?? 0)->take(5);
    }
}
