<?php
$valUsers=array();
for($i=1 ; $i<count($userRating)+1; $i++) {
    $valUsers[$i]=$userRating[$i-1]['memes_id'];
}
for ($i=0; $i<count($memes); $i++) {
    $date=strtotime($memes[$i]['date_create']);
    ?>
    <div class='container' id='container'>
        <header><?=$memes[$i]['name']?></header>
        <img alt='memes' src=<?=BASE_URL.$memes[$i]['path']?> class='img-thumbnail'/>
        <div class='likes_dislikes' id='<?=$memes[$i]['id']?>'>
    <?php
    if (!empty($_SESSION['id']) && !array_search($memes[$i]['id'],$valUsers)) { ?>
            <button type='submit' form='likes' name='like' value='<?=$memes[$i]['id']?>'>
                <img alt='like' src='<?=BASE_URL."css/news/like1.jpg"?>' height='20'/>
            </button>
            <button type='submit' form='dislikes' name='dislike' value='<?=$memes[$i]['id']?>'>
                <img alt='dislike' src='<?=BASE_URL."css/news/dislike1.jpg"?>' height='20'/>
            </button>
    <?php
    } ?>
        </div>
        <div class='row-fluid'>
            <div class='date'>Опубликовано <?= date('j.m.y', $date) ?> в
                <?= date('H:i') ?> by <?= $memes[$i]['username'] ?>
            </div>
            <div class='rating' id='<?= $memes[$i]['id'] ?>'>
                <span class='dislikes'>-<?= $memes[$i]['dislikes'] ?></span>
                <span class='likes'>+<?= $memes[$i]['likes'] ?></span>
            </div>
        </div>
    </div>
<?php
}
?>
<div class='loading'>
    <div>
