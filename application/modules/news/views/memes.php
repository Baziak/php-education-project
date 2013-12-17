<?php
//$action=$this->action;
?>
<script type="text/javascript">
    urlMemes='<?=BASE_URL."news/index/memes"?>'
    action='<?=$this->action?>'
    urlButtons='<?=BASE_URL."news/index/updateLikes"?>'
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
        for ($n=1;$n<count($this->topUsers)+1;$n++) {?>
                <?php if ($n==1) { ?>
                <tr class="firstUser">
                 <td class="users" colspan="2">
                     <img alt='users' src=<?=BASE_URL."images/user_avatars/".$this->topUsers[0]['avatar']?> class='img-thumbnail top-user'/>
                     <p><?=$this->topUsers[0]['username']?></p>
                </td>
                <td></td>
                <?php } else {?>
                <tr class="main">
                    <td class="numeration"><?=$n?>.</td>
                    <td class="users"><?=$this->topUsers[$n-1]['username']?>
                        </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </table>
    </aside>
<section class="news" id="news">
    <ul class="nav nav-tabs">
        <li><a href="<?=BASE_URL."news/index/index"?>">Последние</a></li>
        <li><a href="<?=BASE_URL."news/index/rating"?>">Лучшие</a></li>
    </ul>
    <?php
    for ($i=0; $i<count($this->memes); $i++) {
        $date=strtotime($this->memes[$i]['date_create']);
        ?>
        <div class='container' id='container'>
        <header><?=$this->memes[$i]['name']?></header>
        <img alt='memes' src=<?=BASE_URL.$this->memes[$i]['path']?> class='img-thumbnail'/>
            <div class='likes_dislikes' id='<?=$this->memes[$i]['id']?>'>
            <?php
            if (!empty($_SESSION['userID'])) {
            ?>

            <button type='submit' form='likes' name='like' value='<?=$this->memes[$i]['id']?>'>
                <img alt='like' src='<?=BASE_URL."css/news/like1.jpg"?>' height='20'/>
            </button>
            <button type='submit' form='dislikes' name='dislike' value='<?=$this->memes[$i]['id']?>'>
                <img alt='dislike' src='<?=BASE_URL."css/news/dislike1.jpg"?>' height='20'/>
            </button>
            <?php
            }
            ?>
        </div>
        <div class='row-fluid'><div class='date'>Опубликовано <?=date('j.m.y', $date)?> в
                <?=date('H:i')?> by <?=$this->memes[$i]['username']?>
            </div>
            <div class='rating' id='<?=$this->memes[$i]['id']?>'>
                <span class='dislikes'>-<?=$this->memes[$i]['dislikes']?></span>
                <span class='likes'>+<?=$this->memes[$i]['likes']?></span>
            </div>
        </div>
        </div>
   <?php
    }
    ?>
    <div class='loading'><div>
</section>
</div>