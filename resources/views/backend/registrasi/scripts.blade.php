<script>
    $(document).ready(function() {

        $('.move').click(function() {
            move($(this).data('target'));
            validate($(this).data('current'));
            $(this).addClass('bg-info');
        });
    });

    function move(id) {

        $('.card-content').hide(100);
        $('div .move').removeClass('bg-info');
        $(id).show(100);
        
    }

    function validate(){
        return false; //blm ada validasi jquery
    }
</script>