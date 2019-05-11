<?php

namespace Tests\Unit;

use App\Http\Controllers\SubscriptionsController;
use App\Subscriptions;
use Faker\Factory;
use http\Env\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class createSubscriptionTest extends TestCase
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
