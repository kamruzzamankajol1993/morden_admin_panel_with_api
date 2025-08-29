<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\ReviewImage; 
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class ReviewController extends Controller
{
    public function index()
    {
        return view('admin.reviews.index');
    }

    public function data(Request $request)
    {
        $query = Review::with(['product:id,name', 'customer:id,name']);

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('comment', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('product', function ($q) use ($searchTerm) {
                      $q->where('name', 'like', '%' . $searchTerm . '%');
                  })
                  ->orWhereHas('customer', function ($q) use ($searchTerm) {
                      $q->where('name', 'like', '%' . $searchTerm . '%');
                  });
        }

        $query->orderBy($request->get('sort', 'id'), $request->get('direction', 'desc'));
        $reviews = $query->paginate(10);

        return response()->json([
            'data' => $reviews->items(),
            'total' => $reviews->total(),
            'current_page' => $reviews->currentPage(),
            'last_page' => $reviews->lastPage(),
        ]);
    }

      public function show(Review $review)
    {
        // Eager load images along with product and customer
        $review->load(['product', 'customer', 'images']);
        return view('admin.reviews.show', compact('review'));
    }

    public function edit(Review $review)
    {
        $review->load(['product', 'customer']);
        return view('admin.reviews.edit', compact('review'));
    }

     public function update(Request $request, Review $review)
    {
        $request->validate([
            'comment' => 'nullable|string',
            'published' => 'required|boolean',
            'images' => 'nullable|array', // Validate that 'images' is an array
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048' // Validate each file in the array
        ]);

        $review->update([
            'comment' => $request->comment,
            'published' => $request->published,
        ]);

        // Handle the image upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // Generate a unique name for the image
                $imageName = 'review-' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                // Define the storage path
                $path = 'review_images/' . $imageName;

                // Resize and encode the image using Intervention Image
                $image = Image::make($file)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode();

                // Store the image in the public disk
                Storage::disk('public')->put($path, $image);

                // Create a record in the database
                $review->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('review.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(['message' => 'Review deleted successfully.']);
    }
}