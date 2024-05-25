<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    // check in
    public function checkin(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $attendance = new Attendance;
        $attendance->user_id = $request->user()->id;
        $attendance->date = date('Y-m-d');
        $attendance->time_in = date('H:i:s');
        $attendance->latlon_in = $request->latitude . ', ' . $request->longitude;
        $attendance->save();

        return response([
            'message' => 'Checkin Success',
            'attendance' => $attendance,
        ], 200);
    }

    // checkout
    public function checkout(Request $request)
    {
        // validate lat long
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // get today attendance
        $attendance = Attendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

        // check if attendance not found
        if (!$attendance) {
            return response(['message'=> 'Checkin First'], 400);
        }

        // save checkout
        $attendance->time_out = date('H:i:s');
        $attendance->latlon_out = $request->latitude . ', ' . $request->longitude;
        $attendance->save();

        return response([
            'message' => 'Checkout Success',
            'attendance' => $attendance,
        ], 200);
    }

    // check is checkin
    public function isCheckedIn(Request $request)
    {
        // get today attendance
        $attendance = Attendance::where('user_id', $request->user()->id)
            ->where('date', date('Y-m-d'))
            ->first();

            return response()->json([
                'checkedin' => $attendance ? true : false
            ], 200);
    }


}
