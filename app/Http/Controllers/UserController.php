<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index($week = null)
    {
        $users = User::orderByDesc('id');

        if(!empty($week)) {
            $users = $users->select('*', DB::raw("(COUNT(*)) as count"), DB::raw("DAYNAME(created_at) as dayname"))
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->whereYear('created_at', date('Y'))
                ->groupBy('dayname');
        }

        $users = $users->get();

        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the user details page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return view('pages.users.view', compact('user'));
    }

    public function add(Request $request)
    {
        if ($request->method() == 'GET') {
            $roles = Role::all();
            return view('pages.users.add',[
                'roles' => $roles
            ]);
        }

        try {
            $this->validate($request, [
                'name'      => 'string',
                'email'     => 'string',
                'phone'     => 'string',
                'location'  => 'string',
                'city'      => 'string',
                'password'  => 'required|confirmed',
                'roles'     => ['required', 'array']
            ]);

            $currentUser = Auth::user();
            $user = User::where('phonenumber', $request->phone)->where('email', $request->email)->first();

            if(!$user) {
                $user = new User;
                $user->name  = $request->name;
                $user->email   = $request->email;
                $user->phonenumber  = $request->phone;
                $user->location  = $request->location;
                $user->city = $request->city;
                $user->password     = Hash::make($request->password);
                if($user->save()) {
                    $user->assignRole(implode(',', $request->roles));
                }
            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->withError('Failed to create the user');
        }

        DB::commit();
        Log::info("Registered a user");
        return redirect('/users')->withSuccess('User created successfully');
    }

    public function edit($id, Request $request)
    {
        if (empty($id) && $request->has('id')) {
            $id = $request->id;
        }

        $user = User::find($id);
        if (!$user) {
            return redirect('/users')->withError('User not found');
        }

        if ($request->method() == 'GET') {
            $roles = Role::all();
            $userRoles = Role::whereIn('name',$user->getRoleNames())->pluck('name')->toArray();
            return view('pages.users.edit', [
                'user' => $user,
                'roles' => $roles,
                'userRoles' => $userRoles
            ]);
        }

        try {
            $user->name  = $request->name;
            $user->email   = $request->email;
            $user->phonenumber  = $request->phone;
            $user->location  = $request->location;
            $user->city = $request->city;
            if($request->has('password')) {
                $user->password     = Hash::make($request->password);
            }
            $user->update();
            
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->withError('Could not Update the selected user');
        }

        Log::info("Updated a user record");
        return redirect('/users')->withSuccess('The user is updated successfully');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return back()->withError('User not found');
        }

        if ($request->method() == 'GET') {
            return view('pages.users.change_password');
        }

        try {
            $this->validate($request, [
                'password' => 'required|confirmed',
            ]);

            $user->password = Hash::make($request->password);
            $user->save();
            Log::info("Changed password");
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->withError('Password change failed');
        }

        Log::info("Updated a user record");
        return redirect('/dashboard')->withSuccess('Password updated successfully');
    }

    public function delete(Request $request)
    {
        try {
            $user = User::find($request->user_id);
            $database = app('firebase.firestore');
            $client_id = "";

            $clients =  $database->database()->collection('clients');
            $query = $clients->where('email', '=', $user->email);
            $snapshot = $query->documents();
            foreach($snapshot as $client) {
                $client_id = $client->id();
            }

            Log::info("Deleted User ".$user);

            if($user->delete()) {
                $database->database()->collection('clients')->document($client_id)->delete();
                return redirect()->route('user')->with('success','User deleted successfully!');
            }
        } catch (\Exception $th) {
            return redirect()->route('user')->with('error','User was not deleted');
        }
    }
}
