<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    // عرض قائمة جميع المرضى (الاسم والصورة فقط)
    public function index()
    {
        $patients = Patient::select('id', 'first_name', 'last_name', 'profile_photo')->get();

        return response()->json([
            'patients' => $patients->map(function ($patient) {
                return [
                    'id' => $patient->id,
                    'full_name' => $patient->first_name . ' ' . $patient->last_name,
                    'profile_photo' => $patient->profile_photo 
                        ? asset('storage/profile_photos/' . $patient->profile_photo)
                        : null
                ];
            })
        ], 200);
    }

    // إنشاء مريض جديد
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'age' => 'required|integer|min:1|max:120',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('public/profile_photos');
            $data['profile_photo'] = basename($path);
        }

        $data['registration_date'] = now();
        $data['condition_percentage'] = rand(70, 95);
        $data['condition_description'] = "Lots of different things can cause mouth ulcers...";

        $patient = Patient::create($data);

        return response()->json([
            'message' => 'Patient created successfully',
            'patient' => $patient
        ], 201);
    }

    // عرض مريض محدد
    public function show($id)
    {
        $patient = Patient::findOrFail($id);

        return response()->json([
            'patient' => $patient
        ], 200);
    }

    // تعديل بيانات مريض
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'age' => 'required|integer|min:1|max:120',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            if ($patient->profile_photo) {
                Storage::delete('public/profile_photos/' . $patient->profile_photo);
            }

            $path = $request->file('profile_photo')->store('public/profile_photos');
            $data['profile_photo'] = basename($path);
        }

        $patient->update($data);

        return response()->json([
            'message' => 'Patient updated successfully',
            'patient' => $patient
        ], 200);
    }
}