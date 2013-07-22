<?php
  $routes = array(
    'report-costs' => 'Просмотр стоимостей',
    'report-costs-active' => 'Просмотр текущих стоимостей',
    'report-managers' => 'Зарплата менеджеров',
    'report-workers' => 'Фонд ЗП цеха',
    'report-clients' => 'Клиенты',
    // 'report-materials' => 'Материалы',
    'report-debt' => 'Дебиторка',
    // 'export' => 'Выгрузка в 1С',
  );
?>
<ul class="nav nav-tabs"><?php foreach ($routes as $route => $anchor): ?>
  <li<?php if ($currentRoute == $route): ?> class="active"<?php endif ?>>
    <a href="<?php echo url_for('@' . $route) ?>">
      <?php echo $anchor ?>
    </a>
  </li>
<?php endforeach ?></ul>