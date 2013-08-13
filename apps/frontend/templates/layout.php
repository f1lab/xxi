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
  <style type="text/css">
    body {
      margin: 0 2em;
    }
  </style>
</head>
<body>
<script src="/js/notifications.js"></script>
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

          <?php if ($sf_user->hasCredential('can_edit_suppliers')): ?>
            <li><a href="<?php echo url_for('@suppliers') ?>">Поставщики</a></li>
          <?php endif ?>

          <?php if ($sf_user->hasCredential('can_edit_materials')): ?>
            <li><a href="<?php echo url_for('material/index') ?>">Материалы</a></li>
          <?php endif ?>

          <?php if ($sf_user->hasCredential('can_edit_arrivals')): ?>
            <li><a href="<?php echo url_for('arrival/index') ?>">Поступления материалов</a></li>
          <?php endif ?>
        </ul>

        <ul class="nav pull-right"><?php if ($sf_user->isAuthenticated()): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php echo true == ($name=$sf_user->getName()) ? $name . ' (' . $sf_user->getUsername() . ')' : $sf_user->getUsername() ?>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <?php if ($sf_user->isSuperadmin() || $sf_user->hasGroup('diretor') || $sf_user->hasGroup('buhgalter')): ?>
                <li><a href="<?php echo url_for('comsettings/show?id=1') ?>">Настройки компании</a></li>
              <?php endif ?>
              <?php if ($sf_user->isSuperadmin() || $sf_user->hasGroup('diretor') || $sf_user->hasGroup('buhgalter')): ?>
                <li><a href="<?php echo url_for('sharesettings/show?id=1') ?>">Общие настройки</a></li>
              <?php endif ?>
              <?php if ($sf_user->isSuperadmin() || $sf_user->hasGroup('director')): ?>
                <li><a href="<?php echo url_for('@users-show') ?>">Пользователи</a></li>
              <?php endif ?>
              <li><a href="<?php echo url_for('@users-settings') ?>">Мои настройки</a></li>
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