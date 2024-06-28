<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductMeasurement;
use Illuminate\Http\Request;

class ProductMeasurementController extends Controller
{
    public function index()
    {
        $measurements = ProductMeasurement::orderBy('unit')->get();

        return view('admin.products.measurements.index', compact('measurements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:80',
            'value' => 'required|numeric',
        ]);

        ProductMeasurement::create($validated);

        return redirect()->back()->with('success', ['message' => 'Product measurement has been created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductMeasurement $product_measurement)
    {
        //
    }

    public function edit(ProductMeasurement $product_measurement)
    {
        return view('admin.products.measurements.edit', compact('product_measurement'));
    }

    public function update(Request $request, ProductMeasurement $product_measurement)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:80',
            'value' => 'required|numeric',
        ]);

        $product_measurement->update($validated);

        return redirect()->route('product-measurements.index')->with('success', ['message' => 'Product measurement has been updated']);
    }

    public function destroy(ProductMeasurement $product_measurement)
    {
        $product_measurement->delete();

        return redirect()->route('product-measurements.index')->with('success', ['message' => 'Product measurement has been deleted']);
    }
}
