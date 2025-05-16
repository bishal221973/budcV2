<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {
        return view('test.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'test_name' => 'required',
            'amount' => 'required',
            'comment' => 'nullable'
        ]);


        $test = Test::create($validatedData);


        // return redirect()->route('format-create', $test->id)->with('success', __('Test Created Successfully'));

    }

    public function all()
    {
        $tests = Test::with('ReportFormat')->latest()->paginate(get_option('pagination'));
        return view('test.all', ['tests' => $tests]);
    }

    public function edit($id)
    {
        $test = Test::find($id);
        return view('test.edit', ['test' => $test]);
    }

    public function store_edit(Request $request)
    {

        $validatedData = $request->validate([
            'test_name' => 'required',
        ]);

        $test = Test::find($request->test_id);

        $test->test_name = $request->test_name;
        $test->comment = $request->comment;

        $test->save();

        return redirect()->route('test.all')->with('success', __('Test Edited Successfully'));

    }

        public function destroy($id)
    {

        Test::destroy($id);
        return redirect()->route('test.all')->with('success', __('Test Deleted Successfully'));

    }
}
