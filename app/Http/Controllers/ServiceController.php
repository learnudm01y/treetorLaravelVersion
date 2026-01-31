<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index()
    {
        $services = Service::published()
            ->ordered()
            ->paginate(12);

        return view('services.index', compact('services'));
    }

    /**
     * Display the specified service.
     */
    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Increment views
        $service->increment('views');

        // Get related services
        $relatedServices = Service::published()
            ->where('id', '!=', $service->id)
            ->ordered()
            ->take(3)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }
}
