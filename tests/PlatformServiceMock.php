<?php

namespace Tests;

use Illuminate\Http\Request;
use App\Services\PlatformService;

class PlatformServiceMock implements PlatformService
{
    public function handlePayment(Request $request){}

    public function handleApproval(){}

    public function handleSubscription(Request $request){}

    public function validateSubscription(Request $request){}
}
