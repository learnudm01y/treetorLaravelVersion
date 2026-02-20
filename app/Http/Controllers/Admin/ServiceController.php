<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Service::query()->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('subtitle', 'like', "%{$search}%")
                  ->orWhere('overview', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $services = $query->paginate(10)->withQueryString();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'overview' => 'nullable|string',
            'content' => 'nullable|string',
            'features' => 'nullable|array',
            'benefits' => 'nullable|array',
            'ideal_for' => 'nullable|array',
            'quick_features' => 'nullable|array',
            'price_type' => 'required|in:fixed,custom,from,contact',
            'price' => 'nullable|numeric|min:0',
            'price_note' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:50',
            'cta_text' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:300',
            'status' => 'required|in:draft,published,archived',
            'sort_order' => 'nullable|integer',
            'sections' => 'nullable|array',
            'sections.*.title' => 'required|string|max:255',
            'sections.*.icon' => 'nullable|string|max:100',
            'sections.*.type' => 'required|in:list,grid,text',
            'sections.*.items' => 'nullable|array',
            'sections.*.content' => 'nullable|string',
            'sections.*.sort_order' => 'nullable|integer',
            'sections.*.is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('services', 'public');
            $validated['featured_image'] = $path;
        }

        // Create service
        $sections = $validated['sections'] ?? [];
        unset($validated['sections']);

        $service = Service::create($validated);

        // Create sections
        if (!empty($sections)) {
            foreach ($sections as $sectionData) {
                $service->sections()->create($sectionData);
            }
        }

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'overview' => 'nullable|string',
            'content' => 'nullable|string',
            'features' => 'nullable|array',
            'benefits' => 'nullable|array',
            'ideal_for' => 'nullable|array',
            'quick_features' => 'nullable|array',
            'price_type' => 'required|in:fixed,custom,from,contact',
            'price' => 'nullable|numeric|min:0',
            'price_note' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:50',
            'cta_text' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:300',
            'status' => 'required|in:draft,published,archived',
            'sort_order' => 'nullable|integer',
            'sections' => 'nullable|array',
            'sections.*.title' => 'required|string|max:255',
            'sections.*.icon' => 'nullable|string|max:100',
            'sections.*.type' => 'required|in:list,grid,text',
            'sections.*.items' => 'nullable|array',
            'sections.*.content' => 'nullable|string',
            'sections.*.sort_order' => 'nullable|integer',
            'sections.*.is_active' => 'nullable|boolean',
        ]);

        // Preserve existing arrays if not submitted (empty arrays mean user cleared them)
        // Only keep existing values if the field was not in the request at all
        if (!$request->has('features')) {
            $validated['features'] = $service->features;
        }
        if (!$request->has('benefits')) {
            $validated['benefits'] = $service->benefits;
        }
        if (!$request->has('ideal_for')) {
            $validated['ideal_for'] = $service->ideal_for;
        }
        if (!$request->has('quick_features')) {
            $validated['quick_features'] = $service->quick_features;
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($service->featured_image) {
                Storage::disk('public')->delete($service->featured_image);
            }
            $path = $request->file('featured_image')->store('services', 'public');
            $validated['featured_image'] = $path;
        }

        // Handle sections
        $sections = $validated['sections'] ?? [];
        unset($validated['sections']);

        $service->update($validated);

        // Delete existing sections and recreate them
        $service->sections()->delete();

        if (!empty($sections)) {
            foreach ($sections as $sectionData) {
                $service->sections()->create($sectionData);
            }
        }

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Delete featured image
        if ($service->featured_image) {
            Storage::disk('public')->delete($service->featured_image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
                         ->with('success', 'Service deleted successfully.');
    }

    /**
     * Remove an item from ideal_for array.
     */
    public function removeIdealFor(Request $request, Service $service)
    {
        $index = $request->input('index');

        $idealFor = $service->ideal_for ?? [];

        if (is_array($idealFor) && isset($idealFor[$index])) {
            array_splice($idealFor, $index, 1);
            $service->ideal_for = array_values($idealFor);
            $service->save();

            return response()->json([
                'success' => true,
                'message' => 'Item removed successfully.',
                'ideal_for' => $service->ideal_for
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Item not found.'
        ], 404);
    }

    /**
     * Remove a feature from features array.
     */
    public function removeFeature(Request $request, Service $service)
    {
        $index = $request->input('index');

        $features = $service->features ?? [];

        if (is_array($features) && isset($features[$index])) {
            array_splice($features, $index, 1);
            $service->features = array_values($features);
            $service->save();

            return response()->json([
                'success' => true,
                'message' => 'Feature removed successfully.',
                'features' => $service->features
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Feature not found.'
        ], 404);
    }

    /**
     * Remove a benefit from benefits array.
     */
    public function removeBenefit(Request $request, Service $service)
    {
        $index = $request->input('index');

        $benefits = $service->benefits ?? [];

        if (is_array($benefits) && isset($benefits[$index])) {
            array_splice($benefits, $index, 1);
            $service->benefits = array_values($benefits);
            $service->save();

            return response()->json([
                'success' => true,
                'message' => 'Benefit removed successfully.',
                'benefits' => $service->benefits
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Benefit not found.'
        ], 404);
    }

    /**
     * Remove a quick feature from quick_features array.
     */
    public function removeQuickFeature(Request $request, Service $service)
    {
        $index = $request->input('index');

        $quickFeatures = $service->quick_features ?? [];

        if (is_array($quickFeatures) && isset($quickFeatures[$index])) {
            array_splice($quickFeatures, $index, 1);
            $service->quick_features = array_values($quickFeatures);
            $service->save();

            return response()->json([
                'success' => true,
                'message' => 'Quick feature removed successfully.',
                'quick_features' => $service->quick_features
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Quick feature not found.'
        ], 404);
    }
}
