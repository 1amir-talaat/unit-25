<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller {
    public function showService(Service $service) {
        return view('admin.service.show', compact('service'));
    }

    // Method to delete a service
    public function deleteService(Service $service) {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    // Method to show the form for editing a service
    public function editService(Service $service) {
        return view('admin.service.edit', compact('service'));
    }

    // Method to update a service
    public function updateService(Request $request, Service $service) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'service_category_id' => 'required|exists:service_categories,id',
        ]);

        $service->update($request->all());
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
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
