<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        for ($i = 1; $i <= date('m'); $i++) {
            $income[] = DB::table('customers')
                ->join('payments', 'customers.id', '=', 'payments.customer_id')
                ->select('customers.id', 'customers.status', 'customers.created_at', 'payments.amount')
                ->where('customers.status', 'completed')
                ->whereMonth('customers.created_at', $i)
                ->whereYear('customers.created_at', date('Y'))
                ->orderBy(DB::raw('Month(customers.created_at)'))
                ->sum('payments.amount');
            $month[] = Carbon::create()->month($i)->format('F');
        }

        $projectsCompleted  = Customer::where('status', 'completed')->count();
        $projectsPending    = Customer::where('status', 'pending')->count();
        $projectsInProgress = Customer::where('status', 'in_progres')->count();
        $projectsCancelled  = Customer::where('status', 'cancelled')->count();

        return Inertia::render('Dashboard/Index', [
            'projectsCompleted'     => $projectsCompleted,
            'projectsPending'       => $projectsPending,
            'projectsInProgress'    => $projectsInProgress,
            'projectsCancelled'     => $projectsCancelled,
            'income'                => $income,
            'month'                 => $month
        ]);
    }
}
