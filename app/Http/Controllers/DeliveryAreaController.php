<?php

namespace App\Http\Controllers;

use App\Models\DeliveryArea;
use App\Models\DeliveryLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryAreaController extends Controller
{
    public function index()
    {
        $locations = DeliveryLocation::with('delivery_areas')->get();
        $areas = DeliveryArea::all();
        
        return view('admin.delivery_areas.index', compact('locations', 'areas'));
    }

    public function create()
    {
        $locations = DeliveryLocation::all();

        return view('admin.delivery_areas.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated_area = $request->validate([
            'delivery_location_id' => 'required',
            'area_name' => 'required|string|max:100|unique:delivery_areas',
            'price' => 'required|numeric',
        ]);

        DeliveryArea::create($validated_area);

        return redirect()->route('areas.index')->with('success', ['message' => 'Delivery area has been added.']);
    }

    public function edit(DeliveryArea $area)
    {
        $locations = DeliveryLocation::all();
        
        return view('admin.delivery_areas.edit', compact('locations', 'area'));
    }

    public function update(Request $request, DeliveryArea $area)
    {
        $validated_area = $request->validate([
            'delivery_location_id' => 'required',
            'area_name' => 'required|string|max:100|unique:delivery_areas,area_name,' . $area->id,
            'price' => 'required|numeric',
        ]);

        $area->update($validated_area);

        return redirect()->route('areas.index')->with('success', ['message' => 'Delivery area has been updated.']);
    }

    public function destroy(DeliveryArea $area)
    {
        $area->delete();

        return redirect()->route('areas.index')->with('success', ['message' => 'Delivery area has been deleted.']);
    }
}
