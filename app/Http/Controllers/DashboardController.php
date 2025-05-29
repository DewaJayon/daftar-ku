<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $projectsCompleted  = Customer::where('status', 'completed')->count();
        $projectsPending    = Customer::where('status', 'pending')->count();
        $projectsInProgress = Customer::where('status', 'in_progress')->count();
        $projectsCancelled  = Customer::where('status', 'canceled')->count();

        return Inertia::render('Dashboard', [
            'projectsCompleted'     => $projectsCompleted,
            'projectsPending'       => $projectsPending,
            'projectsInProgress'    => $projectsInProgress,
            'projectsCancelled'     => $projectsCancelled
        ]);
    }
}
