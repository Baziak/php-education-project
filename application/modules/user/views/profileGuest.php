<div class="user-profile row col-md-12">
    <div class="profile-info col-md-3">
        <div class="avatar">
            <img src="<?= BASE_URL . '/images/user_avatars/' . $this->avatar; ?>" class="avatar">
        </div>
        <div class="profile-navigation">
            <ul class="user-info">
                <li><?php echo htmlspecialchars($this->username); ?></li>
                <li><?php echo htmlspecialchars($this->date_of_birth); ?></li>
            </ul>
            <ul class="navigation">
                <li>
                    <button data-<?php echo $this->data; ?>="<?php echo $this->id; ?>" type="button"
                            class="btn btn-default btn-lg <?php echo $this->buttonClass; ?>"><?php echo $this->buttonValue; ?></button>
                </li>
            </ul>
        </div>
    </div>
    <div class="profile-content col-md-9">
        <?php for ($i = 0; $this->MemesNumber > $i; $i++) {
            echo "<div class='meme-zone'><header><a href='/meme/meme/view?id=" . $this->paths_to_my_memes[$i]['id'] . "'>"
                . $this->paths_to_my_memes[$i]['name'] . "</a></header><img src='" .
                BASE_URL . $this->paths_to_my_memes[$i]['path'] . "' class='meme'>
                        <div class='likes_dislikes' id='" . $this->paths_to_my_memes[$i]['id'] . "'>
                            <button type='submit' form='likes' name='like' value='" . $this->paths_to_my_memes[$i]['id'] . "'>
                            <img alt='like' src='" . BASE_URL . "/images/likes/like1.jpg' height='20'/>
                            </button>
                            <button type='submit' form='dislikes' name='dislike' value='" . $this->paths_to_my_memes[$i]['id'] . "'>
                            <img alt='dislike' src='" . BASE_URL . "/images/likes/dislike1.jpg' height='20'/>
                            </button>
                        </div>
                        <div class='rating' id='" . $this->paths_to_my_memes[$i]['id'] . "'>
                            <span class='dislikes'>-" . $this->paths_to_my_memes[$i]['dislikes'] . "</span>
                            <span class='likes'>+" . $this->paths_to_my_memes[$i]['likes'] . "</span>
                        </div>
                 </div>";
        } ?>
    </div>
</div>