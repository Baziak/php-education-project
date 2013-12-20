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
        <div class="span4 offset4 well col-xs-4">
            <legend>Вход</legend>

                <p id="global_error_message_container" class="message_container">
                    <span id="global_error_message"></span>
                    <?php echo $this->global_message ?>
                </p>

            <form method="POST" id="signin_form" action="/user/user/signin" accept-charset="UTF-8">
                <div class="row">
                    <div class="form-group col-xs-10">
                        <input class='username form-control' name='username' id="username" type="text"
                               placeholder="Логин*">
                              <span id="username_message_container" class="message_container">
                                  <span id="username_message"><?php echo $this->username_message ?></span>
                              </span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-10">
                        <input class='password_1 form-control' name="password_1" id="password_1" type="password"
                               placeholder="Пароль*">
                            <span id="password_1_message_container" class="message_container">
                                 <span id="password_1_message"><?php echo $this->password_1_message ?></span>
                           </span>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" form="signin_form" class="send btn btn-default" data-dismiss="modal">отмена
                        </button>
                        <button type="submit" form="signin_form" class="send btn btn-primary" name="send" id="send">ок
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>

