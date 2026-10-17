<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('name')->get();

        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Subject::create($validatedData);

        return redirect()->route('subjects.index')
            ->with('success', 'Materia registrada correctamente.');
    }

    public function show(Subject $subject)
    {
        $subject->load(['gradeActivities' => function ($query) {
            $query->orderBy('date')->orderBy('id');
        }]);

        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject->update($validatedData);

        return redirect()->route('subjects.index')
            ->with('success', 'Materia actualizada correctamente.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Materia eliminada correctamente.');
    }
}
