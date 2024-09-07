@props(['id' => 'dataTable'])

<select class="form-select w-auto" id="filter-dropdown-{{ $id }}">
    <option value="all">Seluruhnya</option>
    {{ $slot }}
</select>
