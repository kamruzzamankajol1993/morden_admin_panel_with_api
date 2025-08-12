<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BundleOffer;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BundleOfferController extends Controller
{
    public function index()
    {
        // The view will now fetch data via AJAX
        return view('admin.offerName.index');
    }

    public function data(Request $request)
    {
        $query = BundleOffer::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('title', 'like', '%' . $request->search . '%');
        }

        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);

        $offers = $query->paginate(10);

        return response()->json([
            'data' => $offers->items(),
            'total' => $offers->total(),
            'current_page' => $offers->currentPage(),
            'last_page' => $offers->lastPage(),
        ]);
    }

    public function create()
    {
        return view('admin.offerName.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $bundleOffer = BundleOffer::create([
                'name' => $request->name,
                'title' => $request->title,
                'status' => $request->status ?? 1,
            ]);

        });

        return redirect()->route('bundle-offer.index')->with('success', 'offer created successfully.');
    }

    public function show(BundleOffer $bundleOffer)
    {
        $bundleOffer = BundleOffer::find($id);
        return view('admin.offerName.show', compact('bundleOffer'));
    }

    public function edit($id)
    {
        $bundleOffer = BundleOffer::find($id);
        return view('admin.offerName.edit', compact('bundleOffer'));
    }

    public function update(Request $request, BundleOffer $bundleOffer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $bundleOffer) {
            $bundleOffer->update([
                'name' => $request->name,
                'title' => $request->title,
                'status' => $request->status ?? 1,
            ]);

          
        });

        return redirect()->route('bundle-offer.index')->with('success', 'offer updated successfully.');
    }

    public function destroy(BundleOffer $bundleOffer)
    {
        $bundleOffer->delete();
        // Return a JSON response for the AJAX call
        return response()->json(['message' => 'offer deleted successfully.']);
    }

    // AJAX method for product search
    public function searchProducts(Request $request)
    {
        $term = $request->get('term');
        $results = [];

        // Search Products that DO NOT have variants
        $products = Product::doesntHave('variants')
            ->where(function ($query) use ($term) {
                $query->where('name', 'LIKE', "%{$term}%")
                      ->orWhere('product_code', 'LIKE', "%{$term}%");
            })
            ->limit(5)
            ->get();

        foreach ($products as $product) {
            $results[] = [
                'id' => $product->id,
                'name' => $product->name,
                'type' => 'product',
                'label' => "{$product->name} (Product)",
            ];
        }

        // Search Product Variants
        $variants = ProductVariant::with('product', 'color')
            ->whereHas('product', function ($query) use ($term) {
                $query->where('name', 'LIKE', "%{$term}%")
                      ->orWhere('product_code', 'LIKE', "%{$term}%");
            })
            ->orWhere('variant_sku', 'LIKE', "%{$term}%")
            ->limit(10)
            ->get();

        foreach ($variants as $variant) {
            $results[] = [
                'id' => $variant->id,
                'name' => "{$variant->product->name} - {$variant->color->name}",
                'type' => 'variant',
                'label' => "{$variant->product->name} - {$variant->color->name} (Variant)",
            ];
        }

        return response()->json($results);
    }
}
