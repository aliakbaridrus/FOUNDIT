<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();
        $items = $user->items()->latest()->get();

        return view('profile.show', compact('user', 'items'));
    }
}
