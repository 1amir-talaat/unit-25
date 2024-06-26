<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller {
    // Method to display all services
    public function index() {
        $services = Service::all();
        return view('admin.index', compact('services'));
    }

    // Method to show the form for editing the specified service
    public function editService(Service $service) {
        $categories = ServiceCategory::all(); // Assuming you have a ServiceCategory model
        return view('admin.edit', compact('service', 'categories'));
    }

    // Method to update the specified service in the database
    public function updateService(Request $request, Service $service) {
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
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    // Method to remove the specified service from the database
    public function destroy(Service $service) {
        // Delete the service
        $service->delete();

        // Redirect to a success page or back to the list
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
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
    public function create() {
        $categories = ServiceCategory::all();
        return view('admin.create', compact('categories'));
    }

    public function store(Request $request) {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:service_categories,id',
        ]);

        // Create and save the service
        Service::create($request->all());

        // Redirect to a success page or back to the form
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }
}
