<?php

namespace Tests\Unit;

use App\Http\Controllers\SubscriptionsController;
use App\Subscriptions;
use Tests\TestCase;

class ViewSingleSubscriptionTest extends TestCase
{
    public function testViewSingle()
    {
        $viewSingleSubscription = new SubscriptionsController();
        $maxSubscriptionId = Subscriptions::all()->sortByDesc('id')->first();
        $singleSubscription = $viewSingleSubscription->show(rand(1, $maxSubscriptionId->id), null);
        $this->assertTrue($singleSubscription);
    }
}
