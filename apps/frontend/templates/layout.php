<!DOCTYPE HTML>
<html lang="ru-RU">
<head>
  <meta charset="UTF-8">
  <?php include_http_metas() ?>
  <?php include_metas() ?>
  <?php include_title() ?>
  <link rel="shortcut icon" href="/favicon.ico" />
  <?php include_stylesheets() ?>
  <link rel="stylesheet" href="<?php echo url_for('main/areaStyles') ?>" />
  <?php include_javascripts() ?>
  <script src="/js/notifications.js"></script>
  <style type="text/css">
    body {
      margin: 0 2em;
    }
  </style>

  <script>
    var App = {
      "add-new-client": "<?php echo url_for("client/add") ?>"
      , "dump-all-clients": "<?php echo url_for("client/dump") ?>"
    };
  </script>
</head>
<body>
  <div class="print hide"></div>
  <div class="navbar">
    <div class="navbar-inner">
      <div class="container">
        <a href="<?php echo url_for('@homepage') ?>" class="brand">21 век</a>

        <?php include_partial('global/topnav') ?>

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

  <script type="text/html" id="template-add-new-client">
    <form action="#" method="post">
      <div class="alert alert-error fill-form hide">
        Заполните все поля формы.
      </div>

      <div class="alert alert-error try-again hide">
        Ошибка сохранения.
      </div>

      <div class="control-group">
        <label class="control-label" for="client_name">Наименование организации</label>
        <div class="controls">
          <input placeholder="Ф1 Лаб" type="text" name="name" id="client_name" class="input-block-level">
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="client_contact">Контактное лицо</label>
        <div class="controls">
          <input type="text" name="contact" id="client_contact" class="input-block-level">
        </div>
      </div>


      <div class="control-group">
        <label class="control-label" for="client_phone">Телефон</label>
        <div class="controls">
          <input type="text" name="phone" id="client_phone" class="input-block-level">
        </div>
      </div>
    </form>
  </script>
</body>
</html>
