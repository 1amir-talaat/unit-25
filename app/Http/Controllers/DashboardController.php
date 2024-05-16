<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function adminDashboard() {
        return view('adminDashboard');
    }

    public function generalUserDashboard() {
        // Fetch all services along with their categories
        $services = Service::with('category')->get();

        // Pass the services to the view
        return view('services', compact('services'));
    }

    public function openTickets() {
        return view('openTickets');
    }
}
