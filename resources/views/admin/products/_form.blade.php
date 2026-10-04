@php($p = $product)

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('products.name') }}</label>
    <input type="text" name="name" value="{{ old('name', $p?->getName() ?? '') }}"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-500">
    @error('name')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('products.description') }}</label>
    <textarea name="description" rows="3"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-500">{{ old('description', $p?->getDescription() ?? '') }}</textarea>
    @error('description')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('products.price') }}</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $p?->getPrice() ?? '') }}"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-500">
    @error('price')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('products.stock') }}</label>
    <input type="number" name="stock" value="{{ old('stock', $p?->getStock() ?? 0) }}"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-500">
    @error('stock')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('products.brand') }}</label>
    <select name="brand_id"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-500">
        <option value="">{{ __('products.select_option') }}</option>
        @foreach ($viewData['brands'] as $brand)
            <option value="{{ $brand->getId() }}" @selected((int) old('brand_id', $p?->getBrandId()) === $brand->getId())>
                {{ $brand->getName() }}
            </option>
        @endforeach
    </select>
    @error('brand_id')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('products.category') }}</label>
    <select name="category_id"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-500">
        <option value="">{{ __('products.select_option') }}</option>
        @foreach ($viewData['categories'] as $category)
            <option value="{{ $category->getId() }}" @selected((int) old('category_id', $p?->getCategoryId()) === $category->getId())>
                {{ $category->getName() }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="mb-6">
    <label class="inline-flex items-center">
        <input type="checkbox" name="active" value="1" @checked(old('active', $p?->getActive() ?? true))
            class="mr-2 rounded border-gray-300">
        <span class="text-sm font-medium text-gray-700">{{ __('products.active') }}</span>
    </label>
</div>