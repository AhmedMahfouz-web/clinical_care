<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    public function index()
    {
        $professions = Profession::all();

        return view('pages.professions.index', compact('professions'));
    }

    public function index_api()
    {
        $professions = Profession::all();

        return response()->json([
            'status' => 'success',
            'professions' => $professions
        ]);
    }

    public function create()
    {
        return view('pages.professions.create');
    }

    public function store(Request $request)
    {
        Profession::create([
            'name' => $request->name,
        ]);

        return redirect()->route('show professions')->with('success', 'تم اضافة التخصص بنجاح');
    }

    public function edit(Profession $profession)
    {
        return view('pages.professions.edit', compact('profession'));
    }

    public function update(Request $request, Profession $profession)
    {
        $profession->update([
            'name' => $request->name,
        ]);

        return redirect()->route('show professions')->with('success', 'تم تعديل التخصص بنجاح');
    }

    public function destroy(Request $request, Profession $profession)
    {
        $profession->delete();

        return redirect()->route('show professions')->with('success', 'تم حذف التخصص بنجاح');
    }
}
