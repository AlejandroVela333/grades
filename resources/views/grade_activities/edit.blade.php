@extends('layouts.app')

@section('title', 'Editar actividad')

@section('content')
    <div class="card">
        <div class="card-header">Editar actividad de {{ $subject->name }}</div>
        <div class="card-body">
            <form action="{{ route('grade-activities.update', [$subject, $gradeActivity]) }}" method="post">
                @csrf
                @method('PUT')
                @include('grade_activities._form')
                <button class="btn btn-primary" type="submit">Guardar cambios</button>
                <a class="btn btn-secondary" href="{{ route('subjects.show', $subject) }}">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
