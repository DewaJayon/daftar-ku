<?php

namespace App\Http\Controllers;

use App\Models\CustomerType as ModelsCustomerType;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerType extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('CustomerType/Index', [
            'customerTypes' => ModelsCustomerType::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $slug = SlugService::createSlug(ModelsCustomerType::class, 'slug', $request->name);

        ModelsCustomerType::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsCustomerType $customerType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $validated['slug'] = SlugService::createSlug(ModelsCustomerType::class, 'slug', $request->name);

        $params = [
            'name' => $request->name,
            'slug' => $validated['slug'],
        ];

        $customerType->update($params);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsCustomerType $customerType)
    {
        try {
            $customerType->delete();
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
        return back();
    }
}
