@props([
    'name',
    'placeholder',
    'type' => 'text'
])

<div class="mb-3" id="container-{{ $name }}">
    <input type="{{ $type }}" id="input-{{ $name }}" name="{{ $name }}" class="form-control" placeholder="{{ $placeholder }}">
    <span class="validation-text text-danger"></span>
</div>
