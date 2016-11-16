<script type="text/javascript">
$(document).ready(function(){
    $('#north').click(function(){
        $.ajax({
            url: index.php?action=move,
            type: 'POST',
            dataType: 'html',
            success: function (data) {
                $('#container').html(data);
            }
        });
    });
});
</script>