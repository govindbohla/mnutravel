<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\TourPackage;
use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = today();

        $stats = [
            'todays_bookings' => Booking::whereDate('journey_date', $today)->count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'completed_bookings' => Booking::where('status', 'completed')->count(),
            'todays_enquiries' => Enquiry::whereDate('created_at', $today)->count(),
            'customers' => Customer::count(),
            'vehicles' => Vehicle::count(),
            'packages' => TourPackage::count(),
        ];

        $recentActivities = Activity::query()
            ->with('causer')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recentActivities'));
    }
}
