<h2>Мои подписки</h2>
<br>
<div>
    <?php
    if (!empty($noEmpty = $this->listSubscriptions)) {
        foreach ($this->listSubscriptions as $dataSubscriptions) {
            foreach ($dataSubscriptions as $fieldSubscriptions) {
                echo "<pre class='container'><div class='avatar'><img src='" . HTTP_URL_PUB . "images/user_avatars/" . $fieldSubscriptions['avatar'];
                echo "' alt='avatar'></div><div class=\"subscriptionsUserName\"><a href='#'>" . $fieldSubscriptions['username'] . "</a></div>";
                echo "<div class='dateUpdateUser'>Был в сети: " . $fieldSubscriptions['date_update'] . "</div>";
                echo "<div class='buttonUnsubscribe'><button data-unsubid=" . $fieldSubscriptions['id'] . " class='btn btn-default btn-lg unsub'>Отписаться</button></div></pre>";
            }
        }
    } else echo "<h4>У Вас нет подписок.</h4>";
    ?>
</div>

