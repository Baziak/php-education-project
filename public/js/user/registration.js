$(function () {
    // $("#global_error_message_container").hide();
    $("#username").focus();

    $("#reg_form").submit(function () {
        var data_ok = true;

        var username = $("#username").val();
        Validator.field_value = username;
        Validator.add('empty', 'true');
        Validator.add('field_pattern', '',
            {pattern: '^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$',
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
            {pattern: '([a-zA-Z]+[0-9]+)|([0-9]+[a-zA-Z]+)',
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

        var password_2 = $("#password_2").val();
        Validator.field_value = password_2;
        Validator.add('empty', 'true');
        Validator.add('equals', '',
            {value_1: password_1, value_2: password_2,
                message: 'Пароли не совпадают !'
            });

        var password_2_message = Validator.run();
        if (!$.isEmptyObject(password_2_message)) {
            data_ok = false;
            show_error_message(password_2_message, 'password_2');
        }
        else {
            hide_error_message('password_2');
        }


        var email = $("#email").val();
        Validator.field_value = email;
        Validator.add('empty', 'true');
        Validator.add('field_pattern', '',
            {pattern: /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
                message: 'Неверный email !'
            });

        var email_message = Validator.run();
        if (!$.isEmptyObject(email_message)) {
            data_ok = false;
            show_error_message(email_message, 'email');
        }
        else {
            hide_error_message('email');
        }

        var date_of_birthday = $("#date_of_birthday").val();
        Validator.field_value = date_of_birthday;
        Validator.add('empty', 'true');
        Validator.add('field_pattern', '',
            {pattern: /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/,
                message: 'Дата не соответствует шаблону !'
            });

        var date_of_birthday_message = Validator.run();
        if (!$.isEmptyObject(date_of_birthday_message)) {
            data_ok = false;
            show_error_message(date_of_birthday_message, 'date_of_birthday');
        }
        else {
            hide_error_message('date_of_birthday');
        }

        Validator.add('empty_all_fields', '', {
            array: [username, password_1, password_2, email, date_of_birthday],
            message: "Звездочки (*) обозначают поля, которые нужно заполнить"});
        var e_mess = Validator.run();
        if (!$.isEmptyObject(e_mess)) {
            show_global_error_message(e_mess);
        }
        return data_ok; // отправка данных на сервер
    });
});

