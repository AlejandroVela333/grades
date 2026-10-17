<div class="form-group">
    <label for="name">Nombre de la materia</label>
    <input id="name" name="name" type="text"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', isset($subject) ? $subject->name : '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
