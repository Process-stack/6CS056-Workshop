<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Display a listing of the courses
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    // Show the form for creating a new course
    public function create()
    {
        return view('courses.create');
    }

    // Store a newly created course in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|unique:courses',
            'description' => 'nullable|string',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')
                         ->with('success', 'Course created successfully.');
    }

    // Display the specified course
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    // Show the form for editing the specified course
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    // Update the specified course in the database
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|unique:courses,code,' . $course->id,
            'description' => 'nullable|string',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')
                         ->with('success', 'Course updated successfully.');
    }

    // Remove the specified course from the database
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
                         ->with('success', 'Course deleted successfully.');
    }
}