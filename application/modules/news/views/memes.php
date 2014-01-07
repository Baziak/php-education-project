<?php
/*$action=$this->action;*/
?>
<script type="text/javascript">
    action = '<?=$this->action?>'
</script>
<div class="headers">
    <header class="top_users"></header>
    <header class="news">News</header>
</div>
<div class="news_content">
    <aside class="top_users">
        <header class="top">Top 10</header>
        <table>
            <?php
            for ($n = 1; $n < count($this->topUsers) + 1; $n++) {
                if ($n == 1) {
                    ?>
                    <tr class="firstUser">
                    <td class="users" colspan="2">
                        <img alt='users' src=<?=
                        BASE_URL . "images/user_avatars/"
                        . $this->topUsers[0]['avatar']?> class='img-thumbnail top-user'/>
                        <p><?= $this->topUsers[0]['username'] ?></p>
                    </td>
                    <td></td>
                <?php
                } else {
                    ?>
                    <tr class="main">
                    <td class="numeration"><?= $n ?>.</td>
                    <td class="users"><?= $this->topUsers[$n - 1]['username'] ?>
                    </td>
                <?php
                }
                ?>
                </tr>
            <?php
            } ?>
        </table>
    </aside>
    <section class="news" id="news">
        <ul class="nav nav-tabs nav-pills">
            <li id="index"><a href="<?= BASE_URL . "news/index/index" ?>">Последние</a></li>
            <li id="rating"><a href="<?= BASE_URL . "news/index/rating" ?>">Лучшие</a></li>
            <?php
            if (!empty ($_SESSION['id'])) {
            ?>
            <li id="subs"><a href="<?= BASE_URL . "news/index/subs" ?>">Подписки</a></li>
            <?php
            }
            ?>
        </ul>
        <?php
        for ($i = 1; $i < count($this->userRating) + 1; $i++) {
            $valUsers[$i] = (int)$this->userRating[$i - 1]['memes_id'];
            $valSub[$i] = (int)$this->sub[$i-1]['target_id'];
        }
        for ($i = 0; $i < count($this->memes); $i++) {
            $date = strtotime($this->memes[$i]['date_create']);
            /*var_dump($valUsers);
            print "<br>".$this->memes[$i]['id'];
            if (array_search($this->memes[$i]['id'],$valUsers)) {
                echo "hello";
            }*/
            ?>
            <div class='container' id='container'>
                <header><?= $this->memes[$i]['name'] ?></header>
                <img alt='memes' src=<?= BASE_URL . $this->memes[$i]['path'] ?> class='img-thumbnail'/>

                <div class='likes_dislikes' id='<?= $this->memes[$i]['id'] ?>'>
                    <?php
                    if (!empty($_SESSION['userID']) && !array_search($this->memes[$i]['id'], $valUsers)) {

                        ?>

                        <button type='submit' form='likes' name='like' value='<?= $this->memes[$i]['id'] ?>'>
                            <img alt='like' src='<?= BASE_URL . "css/news/like1.jpg" ?>' height='20'/>
                        </button>
                        <button type='submit' form='dislikes' name='dislike' value='<?= $this->memes[$i]['id'] ?>'>
                            <img alt='dislike' src='<?= BASE_URL . "css/news/dislike1.jpg" ?>' height='20'/>
                        </button>
                    <?php
                    }
                    ?>
                </div>
                <div class='row-fluid'>
                    <div class='date'>Опубликовано <?= date('j.m.y', $date) ?> в
                        <?= date('H:i') ?> by <?= $this->memes[$i]['username'] ?>
                    </div>
                    <div class='rating' id='<?= $this->memes[$i]['id'] ?>'>
                        <span class='dislikes'>-<?= $this->memes[$i]['dislikes'] ?></span>
                        <span class='likes'>+<?= $this->memes[$i]['likes'] ?></span>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <div class='loading'>
            <div>
    </section>
</div>
