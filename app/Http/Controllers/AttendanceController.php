<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Builder;

class AttendanceController extends Controller
{
    // index
    public function index(Request $request)
    {
        $name = $request->name;
        if ($name) {
            $attendances = Attendance::whereHas('user', function(Builder $query) use ($name){
                $query->where('name', 'like', $name);
            })->orderBy('id', 'desc')->paginate(10);
        } else {
            $attendances = Attendance::with('user')->orderBy('id', 'desc')->paginate(10);
        }
        return view('pages.absensi.index', compact('attendances'));
    }


}
