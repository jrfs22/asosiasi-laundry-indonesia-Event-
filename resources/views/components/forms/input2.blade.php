@props(['name', 'label', 'placeholder', 'type' => 'text', 'required' => true, 'disabled' => false, 'readonly' => false])

<label class="form-label" for="{{ $name }}"> {{ $label }}
    @if ($required)
        <span class="text-danger">*</span>
    @endif
</label>

<input type="{{ $type }}" class="form-control {{ $required ? 'required' : '' }}" id="{{ $name }}"
    name="{{ $name }}" placeholder="{{ $placeholder }}"

    @if ($readonly)
    readonly
    @endif
    />
