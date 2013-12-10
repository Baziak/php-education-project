<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title><?php echo $this->title;?></title>
    <link rel="stylesheet" type="text/css" href=<?php
    print "\"".HTTP_URL_PUB."css/bootstrap.css\""?>/>
    <link rel="stylesheet" type="text/css" href=<?php
    print "\"".HTTP_URL_PUB."css/main-style.css\"";?>/>
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
        <a class="navbar-brand" href="#"><img alt="palette" src=<?="\"".HTTP_URL_PUB."images/palette.png\"";?>></a>
        <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
                <input type="text" class="form-control input-sm"><span class="glyphicon glyphicon-search"></span>
            </div>
        </form>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">Главная</a></li>
                <li><a href="#">Новости</a></li>
            </ul>
        </div>
    </nav>
</header>

<section class="content row col-md-8 col-md-offset-2">
    <?php if($this->addIntoTemplate()) require_once($this->include_file);?>
</section>
<footer class="col-md-8 col-md-offset-2 row">
    &copy; =)
</footer>
</body>
</html>

