<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public static function index()
    {
        $customersNotification = Customer::where('status', 'pending')->select('id', 'name', 'project_name', 'status')->get();

        return $customersNotification;
    }
}
