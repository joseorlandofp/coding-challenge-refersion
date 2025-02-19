<?php

namespace App\Http\Controllers;

use App\Services\AffiliateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeaderboardController extends Controller
{
    private $affiliateService;
    public function __construct(AffiliateService $affiliateService)
    {
        $this->affiliateService = $affiliateService;
    }

    public function index()
    {
        $topFive = $this->affiliateService->topFive();
     
        return view('leaderboard', [
            'topFive' => $topFive
        ]);
    }
}
