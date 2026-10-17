@extends('layouts.app')

@section('title', 'Agregar actividad')

@section('content')
    <div class="card">
        <div class="card-header">Agregar actividad a {{ $subject->name }}</div>
        <div class="card-body">
            <form action="{{ route('grade-activities.store', $subject) }}" method="post">
                @csrf
                @include('grade_activities._form')
                <button class="btn btn-primary" type="submit">Guardar actividad</button>
                <a class="btn btn-secondary" href="{{ route('subjects.show', $subject) }}">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
