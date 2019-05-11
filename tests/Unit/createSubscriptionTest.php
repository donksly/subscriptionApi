<?php

namespace Tests\Unit;

use App\Http\Controllers\SubscriptionsController;
use Faker\Factory;
use Tests\TestCase;

class CreateSubscriptionTest extends TestCase
{
    public function testCreate()
    {
        $faker = Factory::create();

        $data = new \Illuminate\Http\Request(['userName' => $faker->userName], ['email' => $faker->email]);

        $createSubscription = new SubscriptionsController();
        $subscription = $createSubscription->store($data);

        $this->assertTrue($subscription);
    }
}
