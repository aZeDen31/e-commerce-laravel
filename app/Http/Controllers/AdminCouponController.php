<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Coupon;

class AdminCouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric',
            'valid_until' => 'nullable|date'
        ]);

        Coupon::create($request->all());
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon ajouté avec succès.');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon supprimé.');
    }
}
