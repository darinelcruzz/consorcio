<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

<!-- iCheck 1.0.1 -->
<script src="{{ asset('/plugins/icheck.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('/plugins/select2.full.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/dataTables.bootstrap.min.js') }}"></script>

<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>

<script>
$(function () {

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Initialize Select2 Elements
    $(".select2").select2();

    // Data Table With Full Features
    $("#sales").DataTable({
      "order":[[ 0 , "desc"]],
      "paging":false,
      "info":false,
    });
    $("#example1").DataTable({
      "order":[[ 0 , "desc"]]
    });
    $("#example2").DataTable({
      "order":[[ 0 , "desc"]]
    });
    $("#example3").DataTable({
      "order":[[ 0 , "desc"]]
    });
    $("#example4").DataTable({
      "order":[[ 0 , "desc"]]
    });
    $("#example5").DataTable({
      "order":[[ 0 , "desc"]]
    });
    $("#ordered1").DataTable({
      "order":[[ 4 , "desc"]],
      "searching":false,
      "paging":false,
      "info":false,
    });
    $("#ordered2").DataTable({
      "order":[[ 4 , "desc"]],
      "searching":false,
      "paging":false,
      "info":false,
    });
    $("#ordered3").DataTable({
      "order":[[ 4 , "desc"]],
      "searching":false,
      "paging":false,
      "info":false,
    });
    $("#ordered4").DataTable({
      "order":[[ 4 , "desc"]],
      "searching":false,
      "paging":false,
      "info":false,
    });
    $("#ordered5").DataTable({
      "order":[[ 4 , "desc"]],
      "searching":false,
      "paging":false,
      "info":false,
    });
    $("#ordered6").DataTable({
      "order":[[ 4 , "desc"]],
      "searching":false,
      "paging":false,
      "info":false,
    });
    $("#ordered7").DataTable({
      "order":[[ 4 , "desc"]],
      "searching":false,
      "paging":false,
      "info":false,
    });
    $("#ordered8").DataTable({
      "order":[[ 4 , "desc"]],
      "searching":false,
      "paging":false,
      "info":false,
    });
});
</script>
