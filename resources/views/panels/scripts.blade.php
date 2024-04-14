@yield('vendor-script')
<script src="{{ asset(mix('js/app.js')) }}"></script>
<script>
    $(document).ready(function(){
        $("#sidebarCollapse").on('click', function(){
            $("#sidebar").toggleClass('active');
        });
    });
</script>
@yield('page-script')
