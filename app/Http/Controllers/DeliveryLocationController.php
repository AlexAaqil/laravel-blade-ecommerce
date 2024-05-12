<?php

namespace App\Http\Controllers;

use App\Models\DeliveryLocation;
use Illuminate\Http\Request;

class DeliveryLocationController extends Controller
{
    public function index()
    {
        $delivery_locations = DeliveryLocation::latest()->get();
        return view('admin.delivery_locations.index', compact('delivery_locations'));
    }

    public function create()
    {
        return view('admin.delivery_locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string|max:100|unique:delivery_locations',
        ]);

        DeliveryLocation::create($request->only('location_name'));

        return redirect()->route('locations.index')->with('success', ['message' => 'Location has been added.']);
    }

    public function edit(DeliveryLocation $location)
    {
        return view('admin.delivery_locations.edit', compact('location'));
    }

    public function update(Request $request, DeliveryLocation $location)
    {
        $request->validate([
            'location_name' => 'required|string|max:100|unique:delivery_locations,location_name,' . $location->id,
        ]);

        $location->update([
            'location_name' => $request->input('location_name'),
        ]);

        return redirect()->route('locations.index')->with('success', ['message' => 'Location has been updated.']);
    }

    public function destroy(DeliveryLocation $location)
    {
        $location->delete();
        
        return redirect()->route('locations.index')->with('success', ['message' => 'Location and associated areas have been deleted.']);
    }
}
