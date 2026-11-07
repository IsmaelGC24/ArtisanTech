@php($p = $product)

<div class="mb-3">
    <label for="name" class="form-label">{{ __('products.name') }}</label>
    <input type="text" id="name" name="name" value="{{ old('name', $p?->getName() ?? '') }}"
           class="form-control @error('name') is-invalid @enderror">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">{{ __('products.description') }}</label>
    <textarea id="description" name="description" rows="3"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $p?->getDescription() ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="price" class="form-label">{{ __('products.price') }}</label>
    <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $p?->getPrice() ?? '') }}"
           class="form-control @error('price') is-invalid @enderror">
    @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="stock" class="form-label">{{ __('products.stock') }}</label>
    <input type="number" id="stock" name="stock" value="{{ old('stock', $p?->getStock() ?? 0) }}"
           class="form-control @error('stock') is-invalid @enderror">
    @error('stock')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="brand_id" class="form-label">{{ __('products.brand') }}</label>
    <select id="brand_id" name="brand_id" class="form-select @error('brand_id') is-invalid @enderror">
        <option value="">{{ __('products.select_option') }}</option>
        @foreach ($viewData['brands'] as $brand)
            <option value="{{ $brand->getId() }}" @selected((int) old('brand_id', $p?->getBrandId()) === $brand->getId())>
                {{ $brand->getName() }}
            </option>
        @endforeach
    </select>
    @error('brand_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="category_id" class="form-label">{{ __('products.category') }}</label>
    <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
        <option value="">{{ __('products.select_option') }}</option>
        @foreach ($viewData['categories'] as $category)
            <option value="{{ $category->getId() }}" @selected((int) old('category_id', $p?->getCategoryId()) === $category->getId())>
                {{ $category->getName() }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-check mb-4">
    <input type="checkbox" id="active" name="active" value="1" class="form-check-input"
           @checked(old('active', $p?->getActive() ?? true))>
    <label for="active" class="form-check-label">{{ __('products.active') }}</label>
</div>