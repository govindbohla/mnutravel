<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use Illuminate\Contracts\View\View;

class TourPackageController extends Controller
{
    public function index(): View
    {
        return view('front.tour-packages.index', [
            'packages' => TourPackage::active()->latest()->paginate(9),
        ]);
    }

    public function show(TourPackage $tourPackage): View
    {
        abort_unless($tourPackage->status === 'active', 404);

        return view('front.tour-packages.show', [
            'package' => $tourPackage->load('images'),
            'otherPackages' => TourPackage::active()->where('id', '!=', $tourPackage->id)->take(3)->get(),
        ]);
    }
}
