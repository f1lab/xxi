<?php
$routes = [
  'Клиенты' => [
    'credentials' => true,
    'isActive' => $sf_context->getModuleName() == 'client',
    'href' => url_for('@clients'),
  ],
  'Заказы' => [
    'credentials' => true,
    'isActive' => $sf_context->getModuleName() == 'order',
    'href' => url_for('@orders'),
  ],
  'Отчётность' => [
    'credentials' => $sf_user->hasCredential('can_view_reports'),
    'isActive' => $sf_context->getModuleName() == 'report',
    'href' => url_for('@reports'),
  ],
  'Поставщики' => [
    'credentials' => $sf_user->hasCredential('can_edit_suppliers'),
    'isActive' => $sf_context->getModuleName() == 'supplier',
    'href' => url_for('@suppliers'),
  ],
  'Материалы' => [
    'credentials' => $sf_user->hasCredential('can_edit_materials'),
    'isActive' => $sf_context->getModuleName() == 'material',
    'href' => url_for('material/index'),
  ],
  'Поступления материалов' => [
    'credentials' => $sf_user->hasCredential('can_edit_arrivals'),
    'isActive' => $sf_context->getModuleName() == 'arrival',
    'href' => url_for('arrival/index'),
  ],
  'Подрядчики' => [
    'credentials' => $sf_user->hasCredential('can_edit_contractors'),
    'isActive' => $sf_context->getModuleName() == 'contractor',
    'href' => url_for('@contractors'),
  ],
  'Номенклатура' => [
    'credentials' => $sf_user->hasCredential('can_edit_nomenclature'),
    'isActive' => $sf_context->getModuleName() == 'nomenclature',
    'href' => url_for('nomenclature/index'),
  ],
]
?>

<ul class="nav"><?php foreach ($routes as $name => $params): if ($params['credentials']): ?>
  <li <?php if ($params['isActive']) echo 'class="active"' ?>><a href="<?php echo $params['href'] ?>"><?php echo $name ?></a></li>
<?php endif; endforeach ?></ul>
