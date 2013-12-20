$(function () {
    // $("#global_error_message_container").hide();
    $("#username").focus();

    $("#signin_form").submit(function () {
        var data_ok = true;

        var username = $("#username").val();
        Validator.field_value = username;
        Validator.add('empty', 'true');
        Validator.add('field_pattern', '',
            {pattern:'^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$',
                message: 'Поле не валидно!'
            });

        var username_message = Validator.run();
        if (!$.isEmptyObject(username_message)) {
            data_ok = false;
            show_error_message(username_message, 'username');
        }
        else {
            hide_error_message('username');
        }

        var password_1 = $("#password_1").val();
        Validator.field_value = password_1;
        Validator.add('empty', 'true');
        Validator.add('length_between', '', {max: 16, min: 8});
        Validator.add('field_pattern', '',
            {pattern:'([a-zA-Z]+[0-9]+)|([0-9]+[a-zA-Z]+)',
                message: 'Поле должно содержать по крайней мере 1 символ и 1 цифру !'
            });

        var password_1_message = Validator.run();
        if (!$.isEmptyObject(password_1_message)) {
            data_ok = false;
            show_error_message(password_1_message, 'password_1');
        }
        else {
            hide_error_message('password_1');
        }
        Validator.add('empty_all_fields','',{
            array:[username,password_1],
            message:"Звездочки (*) обозначают поля, которые нужно заполнить"});
        var e_mess=Validator.run();
        if(!$.isEmptyObject(e_mess)){
            show_global_error_message(e_mess);
        }
        return data_ok; // отправка данных на сервер
    });
});

