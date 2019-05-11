<?php

namespace Tests\Unit;

use App\Http\Controllers\SubscriptionsController;
use App\Subscriptions;
use Tests\TestCase;

class EditSubscriptionTest extends TestCase
{
    public function testEdit()
    {
        $editSubscription = new SubscriptionsController();
        $maxSubscriptionId = Subscriptions::all()->sortByDesc('id')->first();
        $editedSubscription = $editSubscription->edit(rand(1, 2), rand(1, $maxSubscriptionId->id));
        $this->assertTrue($editedSubscription);
    }
}
