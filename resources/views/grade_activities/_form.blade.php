<div class="form-group">
    <label for="type">Tipo de actividad</label>
    <input id="type" name="type" type="text"
           class="form-control @error('type') is-invalid @enderror"
           value="{{ old('type', isset($gradeActivity) ? $gradeActivity->type : '') }}" required>
    @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="grade">Calificación</label>
    <input id="grade" name="grade" type="number" step="0.01"
           class="form-control @error('grade') is-invalid @enderror"
           value="{{ old('grade', isset($gradeActivity) ? $gradeActivity->grade : '') }}" required>
    @error('grade')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="date">Fecha</label>
    <input id="date" name="date" type="date"
           class="form-control @error('date') is-invalid @enderror"
           value="{{ old('date', isset($gradeActivity) ? $gradeActivity->date->format('Y-m-d') : '') }}" required>
    @error('date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
