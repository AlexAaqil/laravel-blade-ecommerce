<?php

namespace App\Http\Controllers;

use App\Models\ProductMeasurement;
use Illuminate\Http\Request;

class ProductMeasurementController extends Controller
{
    public function index()
    {
        $product_measurements = ProductMeasurement::latest()->get();

        return view('admin.product_measurements.index', compact('product_measurements'));
    }

    public function create()
    {
        return view('admin.product_measurements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'measurement_name' => 'required|string|max:40|unique:product_measurements',
        ]);

        ProductMeasurement::create($validated);

        return redirect()->route('product-measurements.index')->with('success', ['message' => 'Product measurement has been added.']);
    }

    public function edit(ProductMeasurement $product_measurement)
    {
        return view('admin.product_measurements.edit', compact('product_measurement'));
    }

    public function update(Request $request, ProductMeasurement $product_measurement)
    {
        $validated = $request->validate([
            'measurement_name' => 'required|string|max:40|unique:product_measurements,measurement_name,' . $product_measurement->id,
        ]);

        $product_measurement->update($validated);

        return redirect()->route('product-measurements.index')->with('success', ['message' => 'Product measurement has been updated.']);
    }

    public function destroy(ProductMeasurement $product_measurement)
    {
        $product_measurement->delete();

        return redirect()->route('product-measurements.index')->with('success', ['message' => 'Product measurement has been deleted.']);
    }
}
