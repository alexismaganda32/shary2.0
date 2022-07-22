<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
	public function index()
	{
		$logs = Activity::leftJoin('users', 'activity_logs.causer_id', '=', 'users.id')
		->select('activity_logs.*', 'users.name', 'users.surname')
		->latest()
		->paginate(15);

		return view('activitylog', ['logs' => $logs]);
	}
}
