function BadMethodException(message) {
    this.name = 'BadMethod';
    this.message = message;
}
/**
 *
 * @type {{field_value: string,
 * array: Array,  массив обьектов со свойствами name_of_method, breakOnFailure,
 * empty: Function, length_between: Function, field_pattern: Function, isMethodExists: Function, add: Function, setValueToArray: Function, run: Function}}
 */
var Validator = {
    field_value: '',
    array: [],

    empty: function () {
        if (this.field_value == '')
            return "Заполните поле ! ";
        else return '';
    },
    length_between: function (params) {
        if (this.field_value.length > params.max || this.field_value.length < params.min)
            return "Максимальная длинна поля " + params.max + ", минимальная " + params.min + " !";
        else return '';
    },

    field_pattern: function (params) {
        var reg = new RegExp(params.pattern);
        if (!reg.test(this.field_value))
            return params.message;
        else return '';
    },
    equals: function (params) {
        if (params.value_1 != params.value_2)
            return params.message;
        else return '';
    },
    empty_all_fields: function (params) {
        var message = '';
        for (var i in params.array) {
            message += params.array[i];
        }
        if (message == '')
            return params.message;
        else return '';
    },
    isMethodExists: function (method) {
        if (!(method in Validator))
            throw new BadMethodException('Метод ' + method + ' не существует. Проверьте синтаксис! ');
    },

    /**
     *
     * @param name_of_method
     * @param chain если true - в случае если поле не валидно прервать цепочку валидаторов.
     */
    add: function (name_of_method, breakOnFailure, array_of_params) {
        var obj = {name: name_of_method, chain: breakOnFailure, params: array_of_params};
        this.setValueToArray(obj);
    },
    setValueToArray: function (obj) {
        Validator.array [this.array.length] = obj;
    },
    run: function () {
        var error_message = '';
        var stack_of_messages = {};

        try {
            if (this.array.length > 0) {
                for (var i = 0; i < Validator.array.length; i++) {
                    var validation_method = Validator.array[i];
                    this.isMethodExists(validation_method.name);
                    if (validation_method.params != undefined) {
                        error_message = Validator[validation_method.name](validation_method.params);
                    } else {
                        error_message = Validator[validation_method.name]();
                    }
                    console.log("Name: " + validation_method.name);
                    console.log("Message: " + error_message);
                    if (error_message != '') {
                        if (validation_method.chain == 'true') {
                            stack_of_messages[validation_method.name] = error_message;
                            return stack_of_messages;
                        } else {
                            stack_of_messages[validation_method.name] = error_message;
                        }
                    }

                }

            }
        } catch (e) {
            alert(e.message);
            return;
        }
        finally {
            this.array.length = 0;
        }
        return stack_of_messages;
    }


}


function show_error_message(messages, field_name) {
    var message = '';
    for (var i in messages) {
        message += messages[i] + '</br>';
    }
    $('#' + field_name + '_message').html(message);
    // if ($('#' + field_name + '_message_container').is(':hidden')) {
    $('#' + field_name + '_message_container').show("slow");
    // }

}

function show_global_error_message(messages) {
    var message = '';
    for (var i in messages) {
        message += messages[i] + '</br>';
    }
    $("#global_error_message").text(message);
    // if ($('#global_error_message_container').is(':hidden')) {
    $('#global_error_message_container').show("slow");
    //}
}

function hide_error_message(field_name) {
    $('#' + field_name + '_message_container').hide("slow");
}

function hide_global_error_message() {
    if ($('#global_error_message_container').is(':visible')) {
        $('#global_error_message_container').hide("slow");
    }
}

