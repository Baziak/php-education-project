<style type="text/css">
    .message_container {
        font-family: Verdana, sans-serif;
        font-size: 9px;
        font-style: italic;
        color: red;
    }
</style>
<div class="container">
    <div class="row">
        <div class="span8 offset4 well col-xs-6">
            <legend>Регистрация</legend>
            <div class="row">
                <div class="col-md-7">
                    <p id="global_error_message_container" class="message_container">
                        <span id="global_error_message"></span>
                        <?php echo $this->global_message ?>
                    </p>

                    <form id="reg_form" method="POST" action="/user/user/registration" accept-charset="UTF-8">
                        <div class="row">
                            <div class="form-group col-xs-10">
                                <input class='username form-control input-group-lg' name='username' id="username"
                                       type="text" size="10"
                                       placeholder="Логин*">
                              <span id="username_message_container" class="message_container">
                                  <span id="username_message"><?php echo $this->username_message ?></span>
                              </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-10">
                                <input class='password_1 form-control' name="password_1" id="password_1"
                                       type="password"
                                       placeholder="Пароль*">
                            <span id="password_1_message_container" class="message_container">
                                 <span id="password_1_message"><?php echo $this->password_1_message ?></span>
                           </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-10">
                                <input class='password_2 form-control' name="password_2" id="password_2"
                                       type="password"
                                       placeholder="Повторите пароль*">
                            <span id="password_2_message_container" class="message_container">
                                 <span id="password_2_message"><?php echo $this->password_2_message ?></span>
                            </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-10">
                                <input class='email form-control' name="email" type="text" id="email"
                                       placeholder="Email*">
                            <span id="email_message_container" class="message_container">
                                 <span id="email_message"><?php echo $this->email_message ?></span>
                            </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-10">
                                <input class='date_of_birthday form-control' name='date_of_birthday'
                                       id="date_of_birthday"
                                       type="text"
                                       placeholder="Дата рождения*">
                            <span id="date_of_birthday_message_container" class="message_container">
                                  <span
                                      id="date_of_birthday_message"><?php echo $this->date_of_birthday_message ?></span>
                            </span>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="col-md-5">
                    <img src="/images/contact-new.png" alt="альтернативный текст" width="200" height="200">
                </div>
            </div>
            <div class="row">
                <div class="modal-footer">
                    <button type="button" form="reg_form" class="send btn btn-default" data-dismiss="modal">отмена
                    </button>
                    <button type="submit" form="reg_form" class="send btn btn-primary" name="send" id="send">ок
                    </button>
                </div>
            </div>
        </div>
    </div>
</div></div>
</div>
