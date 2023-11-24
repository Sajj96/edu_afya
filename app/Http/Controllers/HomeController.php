<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $doctors = Doctor::count();
        $users = User::count();
        $videos = Video::count();

        $new_users = User::select(DB::raw("(COUNT(*)) as count"), DB::raw("DAYNAME(created_at) as dayname"))
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('dayname')
                    ->get()
                    ->toArray();

        $earnings = UserSubscription::sum('amount');

        $subscriptions = Transaction::select(DB::raw("(COUNT(*)) as count"), DB::raw("DAYNAME(created_date) as dayname"))
            ->whereBetween('created_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->whereYear('created_date', date('Y'))
            ->groupBy('dayname')
            ->get()
            ->toArray();
        $subscription_data = array(0,0,0,0,0,0,0);
        
        foreach($subscriptions as $key=>$subscription) {
            $replace = array($key => $subscription['count']);

            $subscription_data = array_replace($subscription_data, $replace);
        }

        $doctor_categories = DB::table('doctorscategory_tbl')
                        ->join('doctors_tbl','doctorscategory_tbl.name','=','doctors_tbl.category')
                        ->select('doctorscategory_tbl.name',DB::raw("(COUNT(doctorscategory_tbl.name)) as count"))
                        ->groupBy('doctorscategory_tbl.name')
                        ->orderBy('count')
                        ->get()
                        ->toArray();
        $category = array();
        $category_occurrence = array();

        foreach($doctor_categories as $key=>$values) {
            array_push($category, $values->name);
            array_push($category_occurrence, $values->count);
        }

        return view('pages.dashboard', compact('doctors','users','videos','subscription_data','category_occurrence','category','subscriptions','new_users','earnings'));
    }
}
