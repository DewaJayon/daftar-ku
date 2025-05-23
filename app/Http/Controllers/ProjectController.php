<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\Payment;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $customers      = Customer::with(['user', 'customerType', 'payment'])->get();
        $customerTypes  = CustomerType::all();

        return Inertia::render('Projects/Index', [
            'customers'     => $customers,
            'customerTypes' => $customerTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'          => 'required|string|max:255',
            'project_name'  => 'required|string',
            'customer_type' => 'required',
            'tech_stack'    => 'required|string',
            'status'        => 'required',
            'payment_method' => 'required|string',
            'amount'        => 'required|numeric',
        ]);

        $slug = SlugService::createSlug(Customer::class, 'slug', $request->name);

        $paramsCustomerProject = [
            'user_id'           => Auth::user()->id,
            'customer_type_id'  => $request->customer_type,
            'name'              => $request->name,
            'slug'              => $slug,
            'project_name'      => $request->project_name,
            'tech_stack'        => $request->tech_stack,
            'status'            => $request->status,
        ];

        $customer = Customer::create($paramsCustomerProject);

        if ($customer) {

            $isDeposited        = $request->is_deposited === true ? 'yes' : 'no';
            $depositedAmount    = $request->deposited_amount;

            $paymentParams = [
                'customer_id'       => $customer->id,
                'payment_method'    => $request->payment_method,
                'amount'            => $request->amount,
                'is_deposited'      => $isDeposited,
                'deposited_amount'  => $depositedAmount
            ];

            Payment::create($paymentParams);
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $rules = [
            'name'          => 'required|string|max:255',
            'project_name'  => 'required|string',
            'customer_type' => 'required',
            'tech_stack'    => 'required|string',
            'status'        => 'required',
            'payment_method' => 'required|string',
            'amount'        => 'required|numeric',
        ];

        if ($request->is_deposited === true) {
            $rules['deposited_amount'] = 'required|numeric';
        }

        $rules['slug'] = SlugService::createSlug(Customer::class, 'slug', $request->name);

        $request->validate($rules);

        $customerParams = [
            'customer_type_id'  => $request->customer_type,
            'name'              => $request->name,
            'slug'              => $rules['slug'],
            'project_name'      => $request->project_name,
            'tech_stack'        => $request->tech_stack,
            'status'            => $request->status,
        ];

        $customer = Customer::where('slug', $slug)->first();

        $customerUpdate = $customer->update($customerParams);

        if ($customerUpdate) {

            $isDeposited        = $request->is_deposited === true ? 'yes' : 'no';
            $depositedAmount    = $request->deposited_amount;

            $paymentParams = [
                'payment_method'    => $request->payment_method,
                'amount'            => $request->amount,
                'is_deposited'      => $isDeposited,
                'deposited_amount'  => $depositedAmount
            ];

            Payment::where('customer_id', $customer->id)->update($paymentParams);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {

        $customer = Customer::where('slug', $slug)->first();

        if ($customer) {
            $customer->payment->delete();
            $customer->delete();
        }
        return back();
    }
}
