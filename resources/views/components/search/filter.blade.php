@props(['id' => 'dataTable'])

<select class="form-select w-50" id="filter-dropdown-{{ $id }}">
    <option value="all">Seluruhnya</option>
    {{ $slot }}
</select>
