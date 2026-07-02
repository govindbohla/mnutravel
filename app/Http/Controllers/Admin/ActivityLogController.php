<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:users.view'),
        ];
    }

    public function index(): View
    {
        $activities = Activity::query()
            ->with('causer')
            ->latest()
            ->paginate(30);

        return view('admin.activity-log.index', compact('activities'));
    }
}
