@php($b = $brand)

<div class="mb-3">
    <label for="name" class="form-label">{{ __('brands.name') }}</label>
    <input type="text" id="name" name="name" value="{{ old('name', $b?->getName() ?? '') }}"
           class="form-control @error('name') is-invalid @enderror">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="country" class="form-label">{{ __('brands.country') }}</label>
    <input type="text" id="country" name="country" value="{{ old('country', $b?->getCountry() ?? '') }}"
           class="form-control @error('country') is-invalid @enderror">
    @error('country')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="website" class="form-label">{{ __('brands.website') }}</label>
    <input type="text" id="website" name="website" value="{{ old('website', $b?->getWebsite() ?? '') }}"
           class="form-control @error('website') is-invalid @enderror">
    @error('website')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>