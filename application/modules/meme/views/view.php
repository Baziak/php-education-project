<div class="col-md-12" id="meme">
    <img src="<?php echo BASE_URL . $this->meme['path'] ?>" data-id="<?php echo $this->meme['id']?>">
    <?php
    echo "<div class='likes_dislikes' id='" . $this->meme['id'] . "'>
                            <button type='submit' form='likes' name='like' value='" . $this->meme['id'] . "'>
                            <img alt='like' src='" . BASE_URL . "/images/likes/like1.jpg' height='20'/>
                            </button>
                            <button type='submit' form='dislikes' name='dislike' value='" . $this->meme['id'] . "'>
                            <img alt='dislike' src='" . BASE_URL . "/images/likes/dislike1.jpg' height='20'/>
                            </button>
                        </div>
                        <div class='rating' id='" . $this->meme['id'] . "'>
                            <span class='dislikes'>-" . $this->meme['dislikes'] . "</span>
                            <span class='likes'>+" . $this->meme['likes'] . "</span>
                        </div><hr/>";
    echo $this->comments;
    if (isset($_SESSION['id'])) {
        echo "<div id='add_comment'>
        <textarea placeholder=\"Ваше сообщение:\" onfocus=\"placeholder='';\" onblur=\"placeholder='Ваше сообщение:';\" rows='3' cols='45' id='new_comment'></textarea>
        <footer><input id='gocomment' type='button' value='Оставить комментарий' class='btn-default btn'></footer>
        </div>";

    } else {
        echo "<div id='sign'>
        Оставлять комментарии могут только зарегистрированные пользователи.<br/>
        <a href='/user/user/signin'>Войдите на сайт</a> или <a href='/user/user/registration'>зарегистрируйтесь</a>.
        </div>";
    }
    ?>
</div>