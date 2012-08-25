<?php
  $routes = array(
    'report-costs' => 'Просмотр стоимостей',
    'report-costs-active' => 'Просмотр текущих стоимостей',
    'report-managers' => 'Зарплата менеджеров',
    'report-workers' => 'Фонд ЗП цеха',
    'report-clients' => 'Клиенты',
  );
?>
<ul class="nav nav-tabs"><?php foreach ($routes as $route => $anchor): ?>
  <li<?php if ($currentRoute == $route): ?> class="active"<?php endif ?>>
    <a href="<?php echo url_for('@' . $route) ?>">
      <?php echo $anchor ?>
    </a>
  </li>
<?php endforeach ?></ul>