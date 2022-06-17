<script>
$(document).ready(function() {
    $('#example').DataTable();
} );	

</script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/main_javascript.js"></script>
<script src="<?=base_url()?>assets/js/main_jquery.js"></script>
<script src="<?=base_url()?>assets/js/select2.js"></script>
<script>
$( document ).ajaxComplete(function() {
    $('.select2').select2();
} );
$(document).ready(function() {
    $('.select2').select2();
} );	

</script>
</body>
</html>