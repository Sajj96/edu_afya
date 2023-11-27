<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = Subscription::orderByDesc('id')->get();
        return view('pages.transactions.plans.index', ['plans' => $plans]);
    }

    public function add(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('pages.transactions.plans.add');
        }

        $this->validate($request, [
            'name'      => 'required|string',
            'period'    => 'required|string',
            'amount'    => 'required|numeric',
            'type'      => 'required|string'
        ]);

        try {

            $plan = new Subscription;
            $plan->name = $request->name;
            $plan->period = $request->period;
            $plan->amount = $request->amount;
            $plan->type = $request->type;
            $plan->save();

            return redirect()->route('subscription')->withSuccess('Plan created successfully');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->withError('Failed to create plan');
        }
    }

    public function edit(Request $request, $id = null)
    {
        if (empty($id) && $request->has('id')){
            $id = $request->id;
        }

        $plan = Subscription::find($id);

        if ($request->method() == 'GET') {
            return view('pages.transactions.plans.edit', compact('plan'));
        }

        $this->validate($request, [
            'name'      => 'required|string',
            'period'    => 'required|string',
            'amount'    => 'required|numeric',
            'type'      => 'required|string'
        ]);

        try {

            $plan->name = $request->name;
            $plan->period = $request->period;
            $plan->amount = $request->amount;
            $plan->type = $request->type;
            $plan->update();
            return redirect()->route('subscription')->withSuccess('Plan updated successfully');

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->withError('Failed to edit the plan');
        }
    }

    public function delete(Request $request)
    {
        try {
            
            $plan = Subscription::find($request->plan_id);
            if($plan->delete()) {
                return redirect()->route('subscription')->with('success','Plan deleted successfully!');
            }
        } catch (\Exception $th) {
            return back()->with('error','Plan was not deleted');
        }
    }
}
