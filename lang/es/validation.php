<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'string' => 'El campo :attribute debe ser texto.',
    'numeric' => 'El campo :attribute debe ser un número.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'exists' => 'El :attribute seleccionado no es válido.',
    'email' => 'El campo :attribute debe ser un correo electrónico válido.',
    'unique' => 'El :attribute ya está en uso.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'max' => [
        'numeric' => 'El campo :attribute no puede ser mayor que :max.',
        'string' => 'El campo :attribute no puede tener más de :max caracteres.',
        'array' => 'El campo :attribute no puede tener más de :max elementos.',
    ],
    'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
        'array' => 'El campo :attribute debe tener al menos :min elementos.',
    ],

    'attributes' => [
        'name' => 'nombre',
        'description' => 'descripción',
        'price' => 'precio',
        'stock' => 'stock',
        'brand_id' => 'marca',
        'category_id' => 'categoría',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
    ],
];