<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('front.services.index', [
            'services' => Service::active()->ordered()->get(),
        ]);
    }

    public function show(Service $service): View
    {
        abort_unless($service->status === 'active', 404);

        return view('front.services.show', [
            'service' => $service,
            'otherServices' => Service::active()->where('id', '!=', $service->id)->ordered()->take(5)->get(),
        ]);
    }
}
