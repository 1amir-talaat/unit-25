<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller {
    // Method to display all services
    public function index() {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    // Method to show the form for creating a new service
    public function create() {
        return view('services.create');
    }

    // Method to store a newly created service in the database
    public function store(Request $request) {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'service_category_id' => 'required|exists:service_categories,id',
        ]);

        // Create and save the service
        Service::create($request->all());

        // Redirect to a success page or back to the form
        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    // Method to display the specified service
    public function show(Service $service) {
        return view('services.show', compact('service'));
    }

    // Method to show the form for editing the specified service
    public function edit(Service $service) {
        return view('services.edit', compact('service'));
    }

    // Method to update the specified service in the database
    public function update(Request $request, Service $service) {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'service_category_id' => 'required|exists:service_categories,id',
        ]);

        // Update the service
        $service->update($request->all());

        // Redirect to a success page or back to the form
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    // Method to remove the specified service from the database
    public function destroy(Service $service) {
        // Delete the service
        $service->delete();

        // Redirect to a success page or back to the list
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
    public function applyForService(Request $request, Service $service) {
        $user = auth()->user(); // Get the authenticated user

        // Check if the user is already applied for this service
        if ($user->services()->where('service_id', $service->id)->exists()) {
            return redirect()->back()->with('error', 'You have already applied for this service.');
        }

        // Attach the service to the user
        $user->services()->attach($service);

        return redirect()->back()->with('success', 'Application submitted successfully.');
    }
    public function deleteApplication(Service $service) {
        // Get the authenticated user
        $user = auth()->user();

        // Check if the user has applied to this service
        if (!$user->services()->where('service_id', $service->id)->exists()) {
            return redirect()->route('dashboard.open_tickets')->with('error', 'You have not applied to this service.');
        }

        // Detach the service from the user
        $user->services()->detach($service);

        // Redirect back with a success message
        return redirect()->route('dashboard.open_tickets')->with('success', 'Application deleted successfully.');
    }
}
