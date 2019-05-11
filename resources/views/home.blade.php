@extends('layouts.app')
    @section('content')
        <div class="home-div-container">
            <h2>AZOWO Email Subscriptions</h2>

            <button class="btn btn-primary" data-toggle="modal" data-target="#subscriptionModal">
                <i class="fa fa-mouse-pointer"></i> Click to subscribe!
            </button>

            @if (session()->has('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Alert</strong> {{session()->get('message')}}
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
                        <th>Created</th>
                        <th>Last Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (is_array($subscriptions) > 0)
                        <?php $i = 1; ?>
                        @foreach($subscriptions as $subscription)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$subscription->name}}</td>
                                <td>{{$subscription->email}}</td>
                                <td>{{$subscription->subscription_status}}</td>
                                <td>{{$subscription->subscription_status}}</td>
                                <td>{{$subscription->created_at}}</td>
                                <td>{{$subscription->updated_at}}</td>
                            </tr>
                            @endforeach
                        @else
                        <span>No subscribers added!</span>
                        @endif
                    <tr>
                        <td></td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
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
                        <form autocomplete="off" id="subscriptionForm">
                            <div class="modal-body">
                                <h5>Enjoyed this article? Get this and more in your inbox every friday!</h5>
                                <span>
                                    <b>No Spam, ever.</b> We'll never share your email address and you can opt out any time.
                                </span>

                                <div class="form-group">
                                    <label for="userName">Name:</label>
                                    <input type="text" maxlength="30" id="userName" placeholder="Preferred name"
                                           class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="subscriberEmail">Your Email:</label>
                                    <div class="input-group">
                                        <input type="email" maxlength="50" id="subscriberEmail" placeholder="Email"
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