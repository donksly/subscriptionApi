<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Subscriptions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriptionsController extends Controller
{
    public function index()
    {
        $subscriptions = Subscriptions::all();
        $helper = new Helper();
        return view('home', compact('subscriptions'))->with('helper', $helper);
    }

    public function store(Request $request)
    {
        $userName = strtolower($request->get('userName'));
        $email = strtolower($request->get('email'));

        $checkExistence = $this->checkExistence($email);

        $responseStr = 'Email '.$email.' already subscribed under the name '.$userName;

        try {
            if ($checkExistence == 0) {
                $addSubscription = new Subscriptions();
                $addSubscription->name = $userName;
                $addSubscription->email = $email;
                $addSubscription->subscription_status = 0;
                $addSubscription->created_at = Carbon::now();
                $addSubscription->updated_at = Carbon::now();
                $addSubscription->save();

                $responseStr = 'User '.$userName.' successfully added with email '.$email;
            }

            session()->flash('message', response()->json($responseStr));

            /*
             * uncomment for unit test
             * */
            //return true;
        } catch (\Exception $e) {
            /*
             * uncomment for unit test
             * */
            //return false;
        }

        return $this->index();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function checkExistence($email)
    {
        $searchSingleEmail = Subscriptions::all()->where('email', $email)->first();
        $returnFlag = 0;
        if (isset($searchSingleEmail->id)) {
            if (!empty($searchSingleEmail->id)) {
                $returnFlag = 1;
            }
        }
        return $returnFlag;
    }
}
