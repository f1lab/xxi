<!DOCTYPE HTML>
<html lang="ru-RU">
<head>
  <meta charset="UTF-8">
  <?php include_http_metas() ?>
  <?php include_metas() ?>
  <?php include_title() ?>
  <link rel="shortcut icon" href="/favicon.ico" />
  <?php include_stylesheets() ?>
  <?php include_javascripts() ?>
  <script type="text/javascript" src="https://github.com/twitter/bootstrap/diff_blob/e877d125d7a2c673fec4e63600c2d8544c3128f6/docs/assets/js/jquery.tablesorter.js"></script>
  <style type="text/css">
    body {
      width: 1000px;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <div class="navbar-inner">
      <div class="container">
        <a href="<?php echo url_for('@homepage') ?>" class="brand">21 век</a>

        <ul class="nav">
          <li><a href="<?php echo url_for('@clients') ?>">Клиенты</a></li>
          <li><a href="<?php echo url_for('@orders') ?>">Заказы</a></li>

        <?php if ($sf_user->hasCredential('can_view_reports')): ?>
          <li><a href="<?php echo url_for('@reports') ?>">Отчётность</a></li>
        <?php endif ?>
        </ul>

        <ul class="nav pull-right"><?php if ($sf_user->isAuthenticated()): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php echo true == ($name=$sf_user->getName()) ? $name . ' (' . $sf_user->getUsername() . ')' : $sf_user->getUsername() ?>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo url_for('sf_guard_signout') ?>">Выйти</a></li>
            </ul>
          </li>
        </ul><?php endif ?>
      </div>
    </div>
  </div>
  <div class="container">
    <?php if ($sf_user->hasFlash('message') and list($type, $title, $content)=$sf_user->getFlash('message')): ?>
    <div class="alert alert-<?php echo $type ?>">
      <a href="#" class="close" data-dismiss="alert">×</a>
      <strong><?php echo $title ?></strong>
      <?php echo $content ?>
    </div>
    <?php endif ?>

    <?php echo $sf_content ?>
  </div>
</body>
</html>