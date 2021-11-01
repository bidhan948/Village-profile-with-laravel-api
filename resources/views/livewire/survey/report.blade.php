
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $(document).on('change', '#province_id', function(e) {
            @this.set('province_id', e.target.value);
        });
        $(document).on('change', '#district_id', function(e) {
            @this.set('district_id', e.target.value);
        });
        $(document).on('change', '#municipality_id', function(e) {
            @this.set('municipality_id', e.target.value);
        });
    });
</script>
