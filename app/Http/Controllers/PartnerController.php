<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();

        return view('pages.partners.index', compact('partners'));
    }

    public function index_api()
    {
        $partners = Partner::all();

        return response()->json([
            'status' => 'success',
            'partners' => $partners
        ]);
    }

    public function create()
    {
        return view('pages.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required'
        ]);

        $image_name = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/partners'), $image_name);

        Partner::create([
            'image' => $image_name,
        ]);

        return redirect()->route('show partners')->with('success', 'تم اضافة لاشريك بنجاح');
    }

    public function edit(Partner $partner)
    {
        return view('pages.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        if (!empty($request->image)) {
            $image_name = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/partners'), $image_name);

            $partner->update([
                'image' => $image_name,
            ]);
        }
        return redirect()->route('show partners')->with('success', 'تم تعديل الشريك بنجاح');
    }

    public function destroy(Request $request, Partner $partner)
    {
        $partner->delete();

        return redirect()->route('show partners')->with('success', 'تم حذف التخصص بنجاح');
    }
}
