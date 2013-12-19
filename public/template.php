<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title><?php echo $this->title;?></title>
    <link rel="stylesheet" type="text/css" href=<?php
    print "\"".BASE_URL."css/bootstrap.css\""?>/>
    <link rel="stylesheet" type="text/css" href=<?php
    print "\"".BASE_URL."css/main-style.css\"";?>/>
    <script type="text/javascript" src=<?php print "\"".BASE_URL."js/jquery-1.10.2.js\"";?>></script>
    <script type="text/javascript" src=<?php print "\"".BASE_URL."js/likesAjax.js\"";?>></script>
    <script type="text/javascript">
        urlMemes='<?=BASE_URL."news/index/memes"?>'
        urlButtons='<?=BASE_URL."likes/index/updateLikes"?>'
    </script>
    <?php
      foreach($this->getCssFile() as $value)
      {
          print $value;
      }
     foreach($this->getJsFile() as $value)
      {
          print $value;
      }

    ;?>
</head>
<body>
<header>
    <nav class="navbar navbar-default col-md-8 col-md-offset-2 row" role="navigation">
        <a class="navbar-brand" href="#"><img alt="palette" src=<?="\"".BASE_URL."images/palette.png\"";?>></a>
        <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
                <input type="text" class="form-control input-sm"><span class="glyphicon glyphicon-search"></span>
            </div>
        </form>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?=BASE_URL."main/index/index"?>">Главная</a></li>
                <li><a href="<?=BASE_URL."news/index/index"?>">Новости</a></li>
            </ul>
        </div>
    </nav>
</header>

<section class="content row col-md-8 col-md-offset-2">
    <p>
        <a href="/user/user/signin">Вход</a>
        <a href="/user/user/registration">Регистрация</a>
    </p>
    <?php if($this->addIntoTemplate()) require_once($this->include_file);?>
</section>
<footer class="col-md-8 col-md-offset-2 row">
    &copy; =)
</footer>
</body>
</html>

