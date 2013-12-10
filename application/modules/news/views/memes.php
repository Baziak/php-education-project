<header class="news">News</header>
<div class="news">
<?php
for ($i=0; $i<count($this->memes); $i++) {
    echo "<div class=\"container\">"
        ."<header>".$this->memes[$i]['name']."</header>"
    ."<img alt=\"memes\" src=".DIR_USERS.$this->memes[$i]['path']."\" class=\"img-thumbnail\"/>"
    ."<div class=\"likes_dislikes\">"
    ."<form id='likes' action=\"".HTTP_URL_PUB."news/index/like\" method=post></form>"
        ."<form id='dislikes' action=\"".HTTP_URL_PUB."news/index/dislike\" method=post></form>"
    ."<button type='submit' form='likes' name='like' value=\"".$this->memes[$i]['id']."\">
        <img alt=\"like\" src=\"".HTTP_URL_PUB."css/news/like1.jpg\" height=\"20\"/></button>"
    ."<button type='submit' form='dislikes' name='dislike' value=\"".$this->memes[$i]['id']."\">
        <img alt=\"dislike\" src=\"".HTTP_URL_PUB."css/news/dislike1.jpg\" height=\"20\"/></button>";
    $date=strtotime($this->memes[$i]['date_create']);
    print "</div><div class=\"row-fluid\"><div class=\"date\">Опубликовано ".date('j.m.y', $date)." в "
        .date('H:i')." by ".$this->memes[$i]['username']."</div><div class=\"rating\"><span class=\"dislikes\">-"
        .$this->memes[$i]['dislikes']."</span>
        <span class=\"likes\">+".$this->memes[$i]['likes']."</span></div></div>"
    ."</div>";
}

echo "<div class='pages_number'><ul class=\"pagination\">
        <li class=\"disabled\"><a href=\"#\">&larr;</a></li>";
$page=$this->countPages;
for ($j=1; $j<$page+1; $j++) {

        //$ulr="\"".DIR_ROOT."news/index/pagination/$j\">";
        echo "<li><a href=\"".HTTP_URL_PUB."news/index/index?page=$j\">".$j
            ."</a></li>";
}
echo "<li class=\"disabled\"><a href=\"#\">&rarr;</a></li></ul></div>";
/*echo "<pre>";
var_dump($this->memes);*/
?>
</div>