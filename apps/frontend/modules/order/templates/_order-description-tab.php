<table class="table table-condensed table-bordered">
  <colgroup>
    <col class="span3" />
    <col />
  </colgroup>
<?php foreach ($fields as $field => $label):
  $field = 'get' . ucfirst($field);
?>
  <tr>
    <th scope="row"><?php echo $label ?></th>
    <td><?php
    if (in_array($field, array(
      'getDescription',
      'getAdditional',
      'getFiles',
    ))) {
      echo simple_format_text($order->$field());
    } elseif (in_array($field, array(
      'getApprovedAt',
      'getPayedAt',
      'getStartedAt',
      'getFinishedAt',
      'getSubmitedAt',
    ))) {
      echo $order->$field()
        ? date('d.m.Y', strtotime($order->$field()))
        : ''
      ;
    } elseif (in_array($field, array(
      'getDueDate',
      'getExpectedAt',
    ))){
      echo $order->$field()
        ? date('d.m.Y H:i', strtotime($order->$field()))
        : ''
      ;
    } elseif ($field == 'getClientFullestName') {
      echo '<a href="' . url_for('@client?id=' . $order->getClient()->getId()) . '">' . $order->$field() . '</a>';
    } elseif (in_array($field, array(
      'getBillMade',
      'getBillGiven',
      'getDocsGiven',
    ))) {
      echo $order->$field() ? 'Да' : 'Нет';
    } else {
      echo $order->$field();
    }
    ?></td>
  </tr>
<?php endforeach ?>
</table>
