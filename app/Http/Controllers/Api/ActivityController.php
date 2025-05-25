<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityShowRequest;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'people' => 'required|integer|min:1'
        ]);


        return Activity::where('start_date', '<=', $request->date)
            ->where('end_date', '>=', $request->date)
            ->orderBy('popularity', 'desc')
            ->get(['id', 'title', 'price_per_person']);
    }

    public function show($id)
    {
        return Activity::with('recommendedActivities')->find($id);
    }

}
