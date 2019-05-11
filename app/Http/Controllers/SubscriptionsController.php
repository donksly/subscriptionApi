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
        $subscriptions = Subscriptions::all()->sortByDesc('id');
        $helper = new Helper();
        return view('home', compact('subscriptions'))->with('helper', $helper);
    }

    public function store(Request $request)
    {
        $userName = strtolower($request->get('userName'));
        $email = strtolower($request->get('email'));

        $checkExistence = $this->checkExistence($email);

        $returnStr = 'Email '.$email.' already subscribed under the name '.$userName;

        try {
            if ($checkExistence == 0) {
                $addSubscription = new Subscriptions();
                $addSubscription->name = $userName;
                $addSubscription->email = $email;
                $addSubscription->subscription_status = 0;
                $addSubscription->created_at = Carbon::now();
                $addSubscription->updated_at = Carbon::now();
                $addSubscription->save();

                $returnStr = 'User '.$userName.' successfully added with email '.$email;
            }

            session()->flash('message', response()->json($returnStr));

            /*
             * uncomment for unit test
             * */
            return true;
        } catch (\Exception $e) {
            /*
             * uncomment for unit test
             * */
            return false;
        }

        //return $this->index();
    }

    public function show($id)
    {
        //
    }

    public function edit($action, $id)
    {
        $returnStr = "Failure to execute action on subscription!";

        try {
            $findSubscriberById = Subscriptions::find($id);
            if (isset($findSubscriberById->id)) {
                if (($findSubscriberById->subscription_status !== 2 && $action !== 2) || ($action == 1)) {
                    $findSubscriberById->subscription_status = $action;
                    $findSubscriberById->updated_at = Carbon::now();
                    $findSubscriberById->save();

                    $helper = new Helper();
                    $returnStr = 'Subscription for '.$findSubscriberById->email.' has successfully changed status to '.
                        $helper->subscriptionStatus($action);

                    /*
                    * uncomment for unit test
                    * */
                    //return true;
                }
            }
        } catch (\Exception $e) {
            /*
            * uncomment for unit test
            * */
            //return false;
        }
        session()->flash('message', response()->json($returnStr));
        return $this->index();
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
