<?php

namespace App\Http\Controllers;

use App\Models\UserSubscription;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = UserSubscription::lazy();
        return view('pages.transactions.subscription', compact('subscriptions'));
    }
}
