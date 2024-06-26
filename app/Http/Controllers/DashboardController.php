<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller {
    public function generalUserDashboard() {
        // Get the authenticated user
        $user = Auth::user();

        if ($user->type == 1) {
            return Redirect::route('admin.services.index');
        }

        // Fetch services that the user has not applied for along with their categories
        $services = Service::whereDoesntHave('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('category')->get();

        // Pass the services to the view
        return view('services', compact('services'));
    }


    public function openTickets() {
        $user = auth()->user();

        if ($user->type == 1) {
            return Redirect::route('admin.services.index');
        }

        $appliedServices = $user->services()->with('category')->get();

        // Return the view with applied services
        return view('openTickets', compact('appliedServices'));
    }

    
}
