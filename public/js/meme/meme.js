$(document).ready(function () {

    $('#ajax').bind('ajaxSend',function () {
        $(this).show();
    }).bind('ajaxComplete', function () {
            $(this).hide();
        })


    $('.thumb').bind('click', function () {
        if (!$(this).hasClass('selected')) {
            $('#create').children().css('visibility', 'hidden');
            $('#ajax').show();
            $('.thumb').removeClass('selected');
            $(this).addClass('selected');
            var id = $('.selected').data('id');
            var currentPath = window.location.href;
            var data;
            $.post(currentPath.replace('create', 'getImage'), {id: id})
                .done(function (d) {

                    data = $.parseJSON(d);
                    $('#main img').attr('src', baseUrl + data[0].base_picture).data('id', id);
                    $('#main img').load(
                        function () {
                            $('.textarea').remove();
                            if (data[0].width > data[0].height) {
                                var multiplier = data[0].width / $('#main img').width();
                            } else {
                                var multiplier = data[0].height / $('#main img').height();
                            }
                            for (var i = 0; i < data.length; i++) {
                                var div = $('<div>' + (i + 1) + '</div>').addClass('textarea').data('id', (i + 1)).width((data[i].end_x - data[i].start_x) / multiplier)
                                    .height((data[i].end_y - data[i].start_y) / multiplier)
                                    .css('left', (data[i].start_x / multiplier) + 'px').css('top', (data[i].start_y / multiplier) + 'px');
                                $('#main').append(div);
                                $('.textarea').css('font-size', (data[i].end_y - data[i].start_y) / multiplier / 1.5 + 'px');
                                $('#ajax').hide();
                            }
                        }
                    );
                    setInputs(true);
                    $('#create').children().css('visibility', 'visible');
                })
        }
    });

    $('.thumb').first().click();

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
        var inputs = $('.selected').data('inputs');
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

    $('#gocreate').bind('click', function () {
        var inputs = $('#inputs input').not('#name');
        var inputsVal = new Array();
        var id = $('#main img').data('id');
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
            $.post(current.replace('create', 'generate'), {name: name, text: inputsVal, id: id})
                .done(function (data) {
                    window.location.replace(current.replace('create', 'view?id=' + ($.parseJSON(data)).id));
                });

        }
    });
    $('#gocomment').bind('click', function () {
        var text = $('#new_comment').val();
        $(this).unbind('click');
        $.post('/meme/meme/addComment', {comment: text, meme_id: $('#meme img').data('id')})
            .done(function () {
                location.reload();
            });
    })


});