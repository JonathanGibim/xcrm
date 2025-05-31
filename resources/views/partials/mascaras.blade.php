<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
<script>
    $(document).ready(function() {
        
        $('#cpf').mask('000.000.000-00');
        $('#cep').mask('00000-000');
        
        //$('.telefone').mask('(00) 00000-0000');
        var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };
        $('#telefone').mask(SPMaskBehavior, spOptions);

    });
</script>