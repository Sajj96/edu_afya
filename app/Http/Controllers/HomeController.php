<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\Transaction;
use App\Models\User;
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

        $subscriptions = Transaction::select(DB::raw("(COUNT(*)) as count"), DB::raw("DAYNAME(created_at) as dayname"))
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->whereYear('created_at', date('Y'))
            ->where('payments_category', 'Subscription')
            ->groupBy('dayname')
            ->get()
            ->toArray();
        $subscription_data = array(0,0,0,0,0,0,0);

        $consultations = Transaction::select(DB::raw("(COUNT(*)) as count"), DB::raw("DAYNAME(created_at) as dayname"))
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->whereYear('created_at', date('Y'))
            ->where('payments_category', 'Consultation')
            ->groupBy('dayname')
            ->get()
            ->toArray();
        $consultation_data = array(0,0,0,0,0,0,0);
        
        foreach($subscriptions as $key=>$subscription) {
            $replace = array($key => $subscription['count']);

            $subscription_data = array_replace($subscription_data, $replace);
        }

        foreach($consultations as $key=>$consultation) {
            $replacements = array($key => $consultation['count']);

            $consultation_data = array_replace($consultation_data, $replacements);
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

        return view('pages.dashboard', compact('doctors','users','videos','subscription_data','consultation_data','category_occurrence','category','subscriptions','new_users'));
    }
}
