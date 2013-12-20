<div class="wrapper">
    <ul class="nav nav-tabs">
        <li <?php if ($this->view == 'memes') {
            echo 'class="active"';
        } ?>>
            <a href="<?php echo $this->memes_tab; ?>">Публикации</a>
        </li>
        <li <?php if ($this->view == 'users') {
            echo 'class="active"';
        } ?>>
            <a href="<?php echo $this->users_tab; ?>">Пользователи</a>
        </li>
    </ul>
    <div class="search-results">
        <?php if ($this->errors): ?>
            <?php foreach ($this->errors as $error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="list-group">
                <?php if ($this->view == 'memes'): ?>
                    <?php foreach ($this->data as $row): ?>
                        <a href="#" class="list-group-item">
                            <p class="lead"><strong class="label label-info">Мем</strong></p>

                            <div class="pull-left picture">
                                <img class="img-responsive" alt="mem" src="<?php echo BASE_URL . $row['path']; ?>"/>
                            </div>
                            <h4 class="list-group-item-heading">Название: <?php echo $row['name']; ?></h4>

                            <p class="list-group-item-text">Автор: <?php echo $row['username']; ?></p>
                        </a>
                    <?php endforeach; ?>
                <?php elseif ($this->view == 'users'): ?>
                    <?php foreach ($this->data as $row): ?>
                        <a href="#" class="list-group-item">
                            <p class="lead"><strong class="label label-info">Пользователь</strong></p>

                            <div class="pull-left picture">
                                <img class="img-responsive" alt="user" src="<?php echo BASE_URL . $row['avatar']; ?>"/>
                            </div>
                            <h4 class="list-group-item-heading">Имя: <?php echo $row['username']; ?></h4>

                            <p class="list-group-item-text">ID: <?php echo $row['id']; ?></p>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>