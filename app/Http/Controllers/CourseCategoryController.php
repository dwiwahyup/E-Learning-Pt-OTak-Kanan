<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $data = DB::table('course_categories')->get();
        return view('dashboard.coursecategory.index', ['data' => $data]);
    }

    public function create()
    {
        return view('dashboard.coursecategory.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'introduction' => 'required'
        ]);

        DB::table('course_categories')->insert([
            'name' => $request->name,
            'introduction' => $request->introduction
        ]);

        return redirect('/dashboard/coursecategory')->with('success', 'new course category has been added');
    }

    public function edit($id)
    {
        $data = DB::table('course_categories')->where('id', $id)
            ->get();

        return view('dashboard.coursecategory.edit', ['data' => $data]);
    }

    public function update(Request $request)
    {
        DB::table('course_categories')->where('id', $request->id)->update([
            'name' => $request->name,
            'introduction' => $request->introduction
        ]);

        return redirect('/dashboard/coursecategory')->with('success', 'course category has been updated');
    }

    public function delete($id)
    {
        DB::table('course_categories')->where('id', $id)->delete();

        return redirect('/dashboard/coursecategory')->with('success', 'course category has been deleted');
    }
}
