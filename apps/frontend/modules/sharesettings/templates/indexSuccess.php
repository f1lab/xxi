<h1>Share settingss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Waybill count pos on first page</th>
      <th>Waybill count pos on full page</th>
      <th>Waybill count pos on last page</th>
      <th>Waybill counter</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($share_settingss as $share_settings): ?>
    <tr>
      <td><a href="<?php echo url_for('sharesettings/show?id='.$share_settings->getId()) ?>"><?php echo $share_settings->getId() ?></a></td>
      <td><?php echo $share_settings->getWaybillCountPosOnFirstPage() ?></td>
      <td><?php echo $share_settings->getWaybillCountPosOnFullPage() ?></td>
      <td><?php echo $share_settings->getWaybillCountPosOnLastPage() ?></td>
      <td><?php echo $share_settings->getWaybillCounter() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('sharesettings/new') ?>">New</a>
