@props(['name', 'label', 'required' => true])

<label class="form-label" for="{{ $name }}">{{ $label }}

    @if ($required)
        <span class="text-danger">*</span>
    @endif
</label>
<select class="form-select {{ $required ? 'required' : '' }}" id="{{ $name }}" name="{{ $name }}">
    <option value="">Pilih disini</option>
    {{ $slot }}
</select>
