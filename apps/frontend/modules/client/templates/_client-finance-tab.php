<div class="row"><div class="span5">
<table class="table table-condensed table-bordered">
  <colgroup>
    <col />
    <col class="span5" />
  </colgroup>
  <tbody>
    <tr>
      <th scope="row">Кредитная линия</th>
      <td><?php echo (int)$client->getCreditLine() ?></td>
    </tr>
    <tr>
      <th scope="row">Скидка</th>
      <td><?php echo $client->getDiscount() ?>%</td>
    </tr>
    <tr>
      <th scope="row">Заказов в работе на сумму</th>
      <td><?php echo $client->getActiveOrdersSum() ?></td>
    </tr>
    <tr>
      <th scope="row">Дебиторская задолженность</th>
      <td><?php echo $client->getDebtSum() ?></td>
    </tr>
    <tr <?php if ($client->getIsBlacklisted()) echo 'class="text-inverse"' ?>>
      <th scope="row">В чёрном списке?</th>
      <td><?php echo $client->getIsBlacklisted() ? 'Да' : 'Нет' ?></td>
    </tr>
  </tbody>
</table>
</div></div>
