@props(['id' => 'dataTable'])

<div class="table-responsive">
    <table id="{{ $id }}" class="table search-table align-middle text-nowrap">
        <thead class="header-item">
            <tr>
                {{ $slotHead }}
            </tr>
        </thead>
        <tbody>
            {{ $slotBody }}
        </tbody>
    </table>
</div>

@push('scripts')
    <script type="text/javascript">
        var id = {!! json_encode($id) !!}

        $(document).ready(function() {
            var table = $('#' + id).DataTable({
                paging: true,
                searching: true,
                ordering: false,
                info: false,
                lengthChange: false
            });

            $('#input-search').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#filter-dropdown-' + id).on('change', function() {
                var selectedValue = this.value

                if (selectedValue === 'all') {
                    table.search('').draw()
                } else {
                    table.search(selectedValue).draw()
                }
            });
        });
    </script>
@endpush
