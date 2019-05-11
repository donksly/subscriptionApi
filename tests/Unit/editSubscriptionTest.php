<?php

namespace Tests\Unit;

use App\Http\Controllers\SubscriptionsController;
use App\Subscriptions;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class EditSubscriptionTest extends TestCase
{
    public function testEdit()
    {
        $editSubscription = new SubscriptionsController();

        $maxSubscriptionId = Subscriptions::all()->sortByDesc('id')->first();
        Log::info(rand(1, 2). ' - ' .rand(1, $maxSubscriptionId->id));
        $editedSubscription = $editSubscription->edit(rand(1, 2), rand(1, $maxSubscriptionId->id));
        $this->assertTrue($editedSubscription);
    }
}
