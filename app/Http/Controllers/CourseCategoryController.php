<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $query = DB::table('course_categories')
            ->leftJoin('chapters', function ($join) {
                $join->on('course_categories.id', '=', 'chapters.course_categories_id');
            })
            ->select('course_categories.id', 'course_categories.name', 'course_categories.introduction', DB::raw('COUNT(chapters.course_categories_id) as chapters_count'))
            ->groupBy('course_categories.id')
            ->get();
        // dd($query);
        // $data = DB::table('course_categories')->get();
        return view('dashboard.coursecategory.index', ['query' => $query]);
    }

    public function create()
    {
        return view('dashboard.coursecategory.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'introduction' => 'required',
            'images' => 'image'
        ]);

        $images = $request->file('image');

        if ($request->hasFile('image')) {
            $filename = $images->getClientOriginalName();
            $images->move(public_path('/coursecategory/courseimage/'), $filename);
            // $path = $images->store('public/imagecontent');
        } else {
            $filename = null;
        }

        DB::table('course_categories')->insert([
            'name' => $request->name,
            'introduction' => $request->introduction,
            'image_url' => $filename
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
        $data = DB::table('course_categories')->get();

        if ($request->hasFile('image')) {
            $path = public_path() . '/coursecategory/courseimage/';
            // dd($path);

            if ($data->image_url != '' && $data->image_url) {
                $file_old = $path . $data->image_url;
                unlink($file_old);
            }

            $images = $request->file('image');
            $filename = $images->getClientOriginalName();
            $images->move(public_path('/coursecategory/courseimage/'), $filename);

            DB::table('course_categories')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'introduction' => $request->introduction,
                    'image' => $filename
                ]);
        }
        return redirect('/dashboard/coursecategory')->with('success', 'course category has been updated');
    }

    public function delete($id)
    {
        $data = DB::table('course_categories')->get();

        DB::table('course_categories')->where('id', $id)->delete();

        if ($data->image_url != null) {
            $path = public_path() . '/paragraph/imagecontent/';
            $file_old = $path . $data->image_url;
            unlink($file_old);
        }

        return redirect('/dashboard/coursecategory')->with('success', 'course category has been deleted');
    }

    public function preview($id)
    {
        $query = DB::table('users')
            ->where('users.course_categories_id', $id)
            ->orderBy('id')
            ->get();

        // dd($query);

        return view('dashboard.coursecategory.student', ['query' => $query]);
    }
}
