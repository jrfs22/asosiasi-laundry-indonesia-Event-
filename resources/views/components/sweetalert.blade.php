@if (session('sweetalert'))
    <script>
        var alert = {!! json_encode(session('sweetalert')) !!}

        Swal.fire({
            title: alert['title'],
            text: alert['text'],
            icon: alert['icon']
        });
    </script>
@endif

