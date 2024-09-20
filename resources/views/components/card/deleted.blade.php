@props(['route'])

<a href="javascript:void(0)" class="text-dark delete ms-2" data-route="{{ $route }}" onclick="confirmDelete(this)">
    <form id="btnDeleted" method="POST">
        @csrf
        @method('DELETE')
        <i class="ti ti-trash fs-5"></i>
    </form>
</a>

@push('scripts')
    <script>
        function confirmDelete(element) {
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    var route = $(element).data('route');

                    $(element).find('form').attr('action', route);

                    $(element).find('form').submit();
                }
            });
        }
    </script>
@endpush
