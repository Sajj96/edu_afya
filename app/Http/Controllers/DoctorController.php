<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Image;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::lazy();
        return view('pages.doctors.index', compact('doctors'));
    }

    public function show(Request $request, $id)
    {
        $doctor = Doctor::find($id);
        return view('pages.doctors.view', compact('doctor'));
    }

    public function add(Request $request)
    {
        if ($request->method() == 'GET') {
            $categories = DB::table('doctorscategory_tbl')->get();
            return view('pages.doctors.add', compact('categories'));
        }

        try {
            $this->validate($request, [
                'name'        => 'required|string',
                'email'       => 'required|string',
                'profession'  => 'required|string',
                'hospital'    => 'required|string',
                'fee'         => 'required|numeric',
                'password'    => 'required|confirmed',
                'image'       => 'required',
                'image.*'     => 'mimes:jpeg,jpg,png,gif,svg|max:3072',
            ]);

            $doctor = Doctor::where('email', $request->email)->first();

            if (!$doctor) {

                $path = storage_path('/app/public/doctors/');
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                }

                $database = app('firebase.firestore');

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $fileName = $request->image->getClientOriginalName();
                    $extension = $image->extension();
                    $img = Image::make($image->getRealPath());
                    $img->resize(160, 160);

                    $generated = uniqid() . "_" . time() . date("Ymd") . "_IMG";

                    if ($extension == "png") {
                        $fileName = $generated . ".png";
                    } else if ($extension == "jpg") {
                        $fileName = $generated . ".jpg";
                    } else if ($extension == "jpeg") {
                        $fileName = $generated . ".jpeg";
                    } else {
                        return redirect()->back()->with('error', "Invalid file type only png, jpeg and jpg files are allowed.");
                    }

                    $img->save(storage_path('/app/public/doctors/' . $fileName), 90, 'jpg');
                    $fileLink = url('storage/doctors/' . $fileName);
                }

                $doctor = new Doctor;
                $doctor->name  = $request->name;
                $doctor->category  = $request->category;
                $doctor->email   = $request->email;
                $doctor->hospital  = $request->hospital;
                $doctor->image_url  = $fileLink;
                $doctor->profession = $request->profession;
                $doctor->password   = Hash::make($request->password);
                $doctor->bio = $request->bio;
                $doctor->status = $request->status;
                $doctor->consultation_fee = $request->fee;

                if ($doctor->save()) {
                    $doctors =  $database->database()->collection('Doctors')->newDocument();
                    $doctors->set([
                        "profession" => $doctor->profession,
                        "password" => $request->password,
                        "name" => $doctor->name,
                        "phone_number" => $request->phone,
                        "hospital" => $doctor->hospital,
                        "bio" => $request->bio,
                        "email" => $doctor->email,
                        "image_url" => $fileLink,
                        "availability" => "0"
                    ]);
                }
            } else {
                return back()->withError('Doctor exists');
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->withError('Failed to create the doctor');
        }

        DB::commit();
        Log::info("Registered a doctor");
        return redirect('/doctors')->withSuccess('Doctor created successfully');
    }

    public function edit(Request $request, $id)
    {
        $doctor = Doctor::find($request->id);
        $categories = DB::table('doctorscategory_tbl')->get();
        return view('pages.doctors.edit', compact('doctor', 'categories'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required|string',
            'email'       => 'required|string',
            'profession'  => 'required|string',
            'hospital'    => 'required|string',
            'fee'         => 'required|numeric'
        ]);

        try {

            $doctor = Doctor::find($request->id);

            if ($doctor) {

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $fileName = $request->image->getClientOriginalName();
                    $extension = $image->extension();
                    $img = Image::make($image->getRealPath());
                    $img->resize(160, 160);

                    $generated = uniqid() . "_" . time() . date("Ymd") . "_IMG";

                    if ($extension == "png") {
                        $fileName = $generated . ".png";
                    } else if ($extension == "jpg") {
                        $fileName = $generated . ".jpg";
                    } else if ($extension == "jpeg") {
                        $fileName = $generated . ".jpeg";
                    } else {
                        return redirect()->back()->with('error', "Invalid file type only png, jpeg and jpg files are allowed.");
                    }

                    $img->save(storage_path('/app/public/doctors/' . $fileName), 90, 'jpg');
                    $fileLink = url('storage/doctors/' . $fileName);
                }

                $doctor->name  = $request->name;
                $doctor->category  = $request->category;
                $doctor->email   = $request->email;
                $doctor->hospital  = $request->hospital;
                $doctor->image_url  = ($request->hasFile('image')) ? $fileLink : $doctor->image_url;
                $doctor->profession = $request->profession;
                $doctor->bio = $request->bio;
                $doctor->status = $request->status;
                $doctor->consultation_fee = $request->fee;
                $doctor->update();
            } else {
                return back()->withError('Doctor does not exist');
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->withError('Failed to update the doctor');
        }

        DB::commit();
        Log::info("Updated a doctor");
        return redirect('/doctors')->withSuccess('Doctor created successfully');
    }

    public function delete(Request $request)
    {
        try {
            $doctor = Doctor::find((int) $request->doctor_id);
            if ($doctor->delete()) {
                Log::info($doctor);
                return redirect()->route('doctor')->with('success', 'Doctor deleted successfully!');
            }
        } catch (\Exception $th) {
            return redirect()->route('doctor')->with('error', 'Doctor was not deleted');
        }
    }
}
