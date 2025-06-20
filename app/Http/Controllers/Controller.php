<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

abstract class Controller
{
    public function __construct()
    {
        Inertia::share([
            'userRole' => function () {
                $user = Auth::user();
                return $user ? $user->role->name : 'Sin rol';
            },
        ]);
    }
}