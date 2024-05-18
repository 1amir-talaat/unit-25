<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller {

    public function index() {
        $categories = ServiceCategory::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store(Request $request) {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            // Add any other validation rules you need
        ]);

        // Create category
        ServiceCategory::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(ServiceCategory $category) {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, ServiceCategory $category) {
        // Validation
        $request->validate([
            'description' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        // Update category
        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ServiceCategory $category) {
        // Delete category
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
