<?php

namespace App\Http\Controllers;

use App\GradeActivity;
use App\Subject;
use Illuminate\Http\Request;

class GradeActivityController extends Controller
{
    public function create(Subject $subject)
    {
        return view('grade_activities.create', compact('subject'));
    }

    public function store(Request $request, Subject $subject)
    {
        $validatedData = $this->validateActivity($request);

        $subject->gradeActivities()->create($validatedData);

        return redirect()->route('subjects.show', $subject)
            ->with('success', 'Actividad agregada correctamente.');
    }

    public function edit(Subject $subject, GradeActivity $gradeActivity)
    {
        $this->ensureActivityBelongsToSubject($subject, $gradeActivity);

        return view('grade_activities.edit', compact('subject', 'gradeActivity'));
    }

    public function update(Request $request, Subject $subject, GradeActivity $gradeActivity)
    {
        $this->ensureActivityBelongsToSubject($subject, $gradeActivity);

        $gradeActivity->update($this->validateActivity($request));

        return redirect()->route('subjects.show', $subject)
            ->with('success', 'Actividad actualizada correctamente.');
    }

    public function destroy(Subject $subject, GradeActivity $gradeActivity)
    {
        $this->ensureActivityBelongsToSubject($subject, $gradeActivity);

        $gradeActivity->delete();

        return redirect()->route('subjects.show', $subject)
            ->with('success', 'Actividad eliminada correctamente.');
    }

    private function validateActivity(Request $request)
    {
        return $request->validate([
            'type' => 'required|string|max:255',
            'grade' => 'required|numeric',
            'date' => 'required|date',
        ]);
    }

    private function ensureActivityBelongsToSubject(Subject $subject, GradeActivity $gradeActivity)
    {
        abort_unless($gradeActivity->subject_id === $subject->id, 404);
    }
}
