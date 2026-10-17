<?php

namespace Tests\Feature;

use App\GradeActivity;
use App\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GradesCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_subject_can_be_created_viewed_updated_and_deleted()
    {
        $response = $this->post(route('subjects.store'), [
            'name' => 'Diseño de Aplicaciones Web',
        ]);

        $subject = Subject::firstOrFail();
        $response->assertRedirect(route('subjects.index'));
        $this->assertDatabaseHas('subjects', ['name' => 'Diseño de Aplicaciones Web']);

        $this->get(route('subjects.index'))
            ->assertOk()
            ->assertSee('Diseño de Aplicaciones Web');

        $this->get(route('subjects.show', $subject))
            ->assertOk()
            ->assertSee('Actividades evaluables de la materia');

        $this->put(route('subjects.update', $subject), [
            'name' => 'Aplicaciones Web',
        ])->assertRedirect(route('subjects.index'));

        $this->assertDatabaseHas('subjects', ['name' => 'Aplicaciones Web']);

        $this->delete(route('subjects.destroy', $subject))
            ->assertRedirect(route('subjects.index'));

        $this->assertDatabaseMissing('subjects', ['id' => $subject->id]);
    }

    public function test_activity_belongs_to_subject_and_can_be_updated_and_deleted()
    {
        $subject = Subject::create(['name' => 'Diseño de Aplicaciones Web']);

        $this->post(route('grade-activities.store', $subject), [
            'type' => 'Homework',
            'grade' => 95.50,
            'date' => '2026-10-17',
        ])->assertRedirect(route('subjects.show', $subject));

        $activity = GradeActivity::firstOrFail();
        $this->assertEquals($subject->id, $activity->subject_id);
        $this->assertTrue($subject->gradeActivities->contains($activity));

        $this->get(route('subjects.show', $subject))
            ->assertOk()
            ->assertSee('Homework')
            ->assertSee('95.50')
            ->assertSee('2026-10-17');

        $this->put(route('grade-activities.update', [$subject, $activity]), [
            'type' => 'Midterm',
            'grade' => 88,
            'date' => '2026-10-18',
        ])->assertRedirect(route('subjects.show', $subject));

        $this->assertDatabaseHas('grade_activities', [
            'id' => $activity->id,
            'subject_id' => $subject->id,
            'type' => 'Midterm',
            'grade' => 88,
        ]);
        $this->assertSame('2026-10-18', $activity->fresh()->date->format('Y-m-d'));

        $this->delete(route('grade-activities.destroy', [$subject, $activity]))
            ->assertRedirect(route('subjects.show', $subject));

        $this->assertDatabaseMissing('grade_activities', ['id' => $activity->id]);
    }

    public function test_subject_deletion_also_deletes_its_activities()
    {
        $subject = Subject::create(['name' => 'Matemáticas']);
        $activity = $subject->gradeActivities()->create([
            'type' => 'Quick Test',
            'grade' => 90,
            'date' => '2026-10-17',
        ]);

        $this->delete(route('subjects.destroy', $subject));

        $this->assertDatabaseMissing('subjects', ['id' => $subject->id]);
        $this->assertDatabaseMissing('grade_activities', ['id' => $activity->id]);
    }
}
