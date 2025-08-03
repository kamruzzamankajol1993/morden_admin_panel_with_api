<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
class CouponController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all coupons from the database, latest first
        $coupons = Coupon::latest()->paginate(10);
        // Return the view with the list of coupons
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the view for the coupon creation form
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'code' => 'required|string|unique:coupons,code',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'expires_at' => 'nullable|date|after:today',
            'usage_limit' => 'nullable|integer|min:1',
            'usage_limit_per_user' => 'nullable|integer|min:1', // Added validation for the new field
        ]);

        // Create a new coupon with the validated data
        Coupon::create($request->all());

        // Redirect to the coupon index page with a success message
        return redirect()->route('coupon.index')
                         ->with('success', 'Coupon created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        // Return the view showing coupon details
        return view('admin.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        // Return the view for the coupon editing form
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        // Validate the incoming request data
        $request->validate([
            'code' => 'required|string|unique:coupons,code,' . $coupon->id,
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'expires_at' => 'nullable|date|after:today',
            'usage_limit' => 'nullable|integer|min:1',
            'usage_limit_per_user' => 'nullable|integer|min:1', // Added validation for the new field
            'is_active' => 'sometimes|boolean',
        ]);

        // Update the coupon with the validated data
        $coupon->update($request->all());

        // Redirect to the coupon index page with a success message
        return redirect()->route('coupon.index')
                         ->with('success', 'Coupon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        // Delete the coupon
        $coupon->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('coupon.index')
                         ->with('success', 'Coupon deleted successfully.');
    }

    public function applyCoupon(Request $request)
{
    $request->validate([
        'coupon_code' => 'required|string',
        'total_price' => 'required|numeric|min:0',
    ]);

    $coupon = Coupon::where('code', $request->coupon_code)->first();

    // --- Validation Checks ---
    if (!$coupon) {
        return response()->json(['success' => false, 'message' => 'Invalid coupon code.']);
    }
    if (!$coupon->is_active) {
        return response()->json(['success' => false, 'message' => 'This coupon is not active.']);
    }
    if ($coupon->expires_at && $coupon->expires_at->isPast()) {
        return response()->json(['success' => false, 'message' => 'This coupon has expired.']);
    }
    if ($coupon->usage_limit && $coupon->times_used >= $coupon->usage_limit) {
        return response()->json(['success' => false, 'message' => 'This coupon has reached its usage limit.']);
    }
    
    // You would also add checks for user-specific limits here,
    // using the 'coupon_user' pivot table we discussed.

    // --- Calculate Discount ---
    $discountAmount = 0;
    if ($coupon->discount_type == 'percentage') {
        $discountAmount = ($request->total_price * $coupon->discount_value) / 100;
    } else { // 'fixed'
        $discountAmount = $coupon->discount_value;
    }

    // Ensure discount doesn't exceed total price
    $discountAmount = min($discountAmount, $request->total_price);

    return response()->json([
        'success' => true,
        'message' => 'Coupon applied successfully!',
        'discount_amount' => round($discountAmount, 2)
    ]);
}
}
