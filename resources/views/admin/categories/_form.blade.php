@php($c = $category)

<div class="mb-3">
    <label for="name" class="form-label">{{ __('categories.name') }}</label>
    <input type="text" id="name" name="name" value="{{ old('name', $c?->getName() ?? '') }}"
           class="form-control @error('name') is-invalid @enderror">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="form-label">{{ __('categories.description') }}</label>
    <textarea id="description" name="description" rows="3"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $c?->getDescription() ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
