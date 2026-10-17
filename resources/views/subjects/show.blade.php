@extends('layouts.app')

@section('title', $subject->name)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="mb-1">{{ $subject->name }}</h1>
            <p class="text-muted mb-0">Actividades evaluables de la materia</p>
        </div>
        <a class="btn btn-success" href="{{ route('grade-activities.create', $subject) }}">
            Agregar actividad
        </a>
    </div>

    <div class="mb-3">
        <a class="btn btn-primary" href="{{ route('subjects.edit', $subject) }}">Editar materia</a>
        <a class="btn btn-secondary" href="{{ route('subjects.index') }}">Regresar a materias</a>
    </div>

    <table class="table table-striped table-bordered bg-white">
        <thead class="thead-dark">
            <tr>
                <th>Tipo de actividad</th>
                <th>Calificación</th>
                <th>Fecha</th>
                <th colspan="2">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subject->gradeActivities as $activity)
                <tr>
                    <td>{{ $activity->type }}</td>
                    <td>{{ number_format((float) $activity->grade, 2) }}</td>
                    <td>{{ $activity->date->format('Y-m-d') }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm"
                           href="{{ route('grade-activities.edit', [$subject, $activity]) }}">
                            Editar actividad
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('grade-activities.destroy', [$subject, $activity]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('¿Deseas eliminar esta actividad?')">
                                Eliminar actividad
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Esta materia todavía no tiene actividades.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
