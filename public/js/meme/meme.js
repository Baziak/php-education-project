$(document).ready(function () {

    $('.thumb').first().addClass('selected');
    var path = $('.selected').attr('src');
    path = path.replace('/thumb/', '/orig/');
    $('#main img').attr('src', path);
    setInputs(true);


    $('.thumb').bind('click', function () {
        $('.thumb').removeClass('selected');
        $(this).addClass('selected');
        var path = $('.selected').attr('src');
        path = path.replace('/thumb/', '/orig/');
        $('#main img').attr('src', path);
        setInputs(true);
    });

    $('#inputs input').focus(function () {
        if ($(this).hasClass('initial'))
            $(this).removeClass('initial').val('');
    });

    $('#inputs input').focusout(function () {
        if ($.trim($(this).val()) == '') {
            $(this).addClass('initial').val($(this).attr('id'));
            if ($(this).attr('id') == 'name')
                $(this).val('Название мема');
        }
    });

    function setInputs(changed) {
        $('#inputs input').not('#name').hide();
        var inputs = $('.selected').attr('inputs');
        if (!$('#name').hasClass('initial') && changed) {
            $('#name').val('Название мема').addClass('initial');
        }
        for (var i = 1; i <= inputs; i++) {
            $('#inputs #' + i).show();
            if ($('#inputs #' + i).hasClass('initial') || changed) {
                $('#inputs #' + i).val(i).addClass('initial');
            }
        }
    };

    $('input[type*="button"]').bind('click', function () {
        var inputs = $('#inputs input').not('#name');
        var inputsVal = new Array();
        var path = $('#main img').attr('src');
        var name = $.trim($('#name').val());

        for (var i = 0; i < inputs.length; i++) {
            if ($(inputs[i]).hasClass('initial')) {
                $(inputs[i]).val('');
            } else if ($(inputs[i]).is(':visible') && $.trim($(inputs[i]).val()) != '') {
                inputsVal[i] = $.trim($(inputs[i]).val());
            }
        }


        if ($('#name').hasClass('initial')) {
            alert('Введите название создаваемого мема');
            setInputs(false);
        } else if (inputsVal.length < 1) {
            alert('Заполните хотя бы одно поле ввода!');
            setInputs(false);
        } else {
            var div = $('<div></div>').addClass('darkened');
            $('body').append(div);
            $('#ajax').show();
            var current = window.location.href;
            $.post(current.replace('create', 'generate'), {name: name, text: inputsVal, path: path})
                .done(function(data){
                   window.location.replace(current.replace('create', 'view?id='+ ($.parseJSON(data)).id))
                });



        }

    });


});