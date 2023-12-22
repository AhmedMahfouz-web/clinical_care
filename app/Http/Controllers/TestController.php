<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();

        return view('pages.tests.index', compact('tests'));
    }

    public function create()
    {
        return view('pages.tests.create');
    }

    public function store(Request $request)
    {
        Test::create([
            'name' => $request->name,
            'type' => $request->type
        ]);

        return redirect()->route('show tests')->with('success', 'تم اضافة الاشعة او التحليل بنجاح');
    }

    public function edit(Test $test)
    {
        return view('pages.tests.edit', compact('test'));
    }

    public function update(Request $request, Test $test)
    {
        $test->update([
            'name' => $request->name,
            'type' => $request->address
        ]);

        return redirect()->route('show tests')->with('success', 'تم تعديل الاشعة او التحليل بنجاح');
    }

    public function destroy(Request $request, Test $test)
    {
        $test->delete();

        return redirect()->route('show tests')->with('success', 'تم حذف الاشعة او التحليل بنجاح');
    }
}
