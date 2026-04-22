<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::where('status', 'available');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        if ($request->filled('max_price')) {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        $vehicles = $query->orderBy('price_per_day')->paginate(12)->withQueryString();

        return view('public.catalog', compact('vehicles'));
    }
}
