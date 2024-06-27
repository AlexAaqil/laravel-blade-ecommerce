@props(['url'])
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/jquery_ui.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#sortable").sortable({
            update: function(event, ui) {
                var item_id = [];
                $('.sortable_item').each(function() {
                    var id = $(this).attr('id');
                    item_id.push(id);
                });

                $.ajax({
                    type: "POST",
                    url: "{{ $url }}",
                    data: {
                        "item_id": item_id,
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        location.reload();
                    },
                    error: function(data) {
                        console.error('Error:', data);
                    }
                });
            }
        });
    });
</script>
