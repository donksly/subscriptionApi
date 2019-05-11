@extends('layouts.app')
    @section('content')
        <div class="home-div-container">
            <h2>AZOWO Email Subscriptions</h2>

            <div class="row col-md-8">
                <div class="col col-md-2">
                    <a href="{{ url('/') }}" class="btn btn-default">
                        <i class="fa fa-home fa-2x"></i>
                    </a>
                </div>
                <div class="col col-md-4">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#subscriptionModal">
                        <i class="fa fa-mouse-pointer"></i> Click to subscribe!
                    </button>
                </div>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Response</strong> {{json_encode(session()->get('message'), JSON_PRETTY_PRINT) }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

            <div class="subscribersListDiv">
                <h4>Subscribers List</h4>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>View</th>
                        <th>Created</th>
                        <th>Last Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($subscriptions))
                        <?php $i = 1; ?>
                        @foreach($subscriptions as $subscription)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $subscription->name }}</td>
                                <td>{{ $subscription->email }}</td>
                                <td>{{ $helper->subscriptionStatus($subscription->subscription_status) }}</td>
                                <td>
                                    @if ($subscription->subscription_status == 0)
                                            <a href="/api/update_subscription/{{1}}/{{$subscription->id}}"
                                               class="btn btn-success btn-sm">Confirm Subscription</a>

                                        @elseif($subscription->subscription_status == 1)
                                           <a href="/api/update_subscription/{{2}}/{{$subscription->id}}"
                                              class="btn btn-danger btn-sm">Unsubscribe</a>

                                        @elseif($subscription->subscription_status == 2)
                                            <a href="javascript:;" class="btn btn-secondary disabled btn-sm">
                                                {{ $helper->subscriptionStatus($subscription->subscription_status) }}
                                            </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="/api/show/{{$subscription->id}}" class="btn btn-info btn-sm">View</a>
                                </td>
                                <td>{{ $helper->formatDateTime($subscription->created_at) }}</td>
                                <td>{{ $helper->formatDateTime($subscription->updated_at) }}</td>
                            </tr>
                            @endforeach
                        @else
                            <span>No subscribers added!</span>
                        @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>View</th>
                        <th>Created</th>
                        <th>Last Updated</th>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="modal fade" id="subscriptionModal" tabindex="-1" role="dialog" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="subscriptionModalLabel">Azowo Subscription</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/api/create_subscription" method="post" autocomplete="off" id="subscriptionForm">
                            @csrf
                            <div class="modal-body">
                                <h5>Enjoyed this article? Get this and more in your inbox every friday!</h5>
                                <span>
                                    <b>No Spam, ever.</b> We'll never share your email address and you can opt out any time.
                                </span>

                                <div class="form-group">
                                    <label for="userName">Name:</label>
                                    <input type="text" name="userName" maxlength="30" id="userName" placeholder="Preferred name"
                                           class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="subscriberEmail">Your Email:</label>
                                    <div class="input-group">
                                        <input type="email" name="email" maxlength="50" id="subscriberEmail" placeholder="Email"
                                               class="form-control"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" type="submit"><i class="fa fa-send"></i> Subscribe!</button>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        @endsection