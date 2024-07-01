@props(['type', 'id', 'name', 'placeholder'])
<input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
    required {{ $attributes->merge(['class' => 'input']) }} />
