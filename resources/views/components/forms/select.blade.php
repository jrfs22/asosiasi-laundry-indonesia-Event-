@props(['name', 'label', 'required' => true])

<label class="form-label" for="{{ $name }}">{{ $label }}

    @if ($required)
        <span class="text-danger">*</span>
    @endif
</label>
<select class="form-select" id="{{ $name }}" name="{{ $name }}"
@if ($required)
    required
@endif
>
    <option value="">Pilih disini</option>
    {{ $slot }}
</select>
