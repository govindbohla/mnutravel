<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactDetail;
use Illuminate\Contracts\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('front.contact.index', [
            'contactDetail' => ContactDetail::first(),
        ]);
    }
}
