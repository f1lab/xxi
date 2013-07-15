<?php use_helper('Text') ?>
<div class="page-header">
  <ul class="pager pull-right"><?php
    $version = $order['version'];
    $cantclick1 = $cantclick2 = false;
  ?>
    <li<?php if ($version-1 < 1):
      $cantclick1 = true;
      echo ' class="disabled"';
    endif ?>>
      <a href="<?php echo ($cantclick1 ? '#' : '') . url_for('@order?id=' . $order->getId() . '&version=' . ($version-1))
        ?>">← версия <?php echo $version-1 ?></a>
    </li>
    <li class="active">
      версия <?php echo $version ?> от <?php echo $order->getUpdatedAt() ?>
    </li>
    <li<?php if ($order->getAuditLog()->getMaxVersion($sf_data->getRaw('order')) == $version):
      $cantclick2 = true;
      echo ' class="disabled"';
    endif ?>>
      <a href="<?php echo ($cantclick2 ? '#' : '') . url_for('@order?id=' . $order->getId() . '&version=' . ($version+1))
        ?>">версия <?php echo $version+1 ?>→</a>
    </li>
  </ul>
  <h1>Заказ №<?php echo $order->getId() ?></h1>
</div>

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
      'getDueDate',
      'getApprovedAt',
      'getPayedAt',
      'getStartedAt',
      'getFinishedAt',
      'getSubmitedAt',
      'getExpectedAt',
    ))) {
      echo $order->$field()
        ? date('d.m.Y', strtotime($order->$field()))
        : ''
      ;
    } elseif (in_array($field, array('getExecutionTime',))){
      echo $order->$field();
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

<div class="btn-toolbar">
<?php
  if ( //TODO: replace this mess with some permission or move this check to model
    $sf_user->hasGroup('manager')
      && $order->getCreatedBy() == $sf_user->getGuardUser()->getId()
      && !in_array($order->getState(), array('debt', 'archived'))
    or $sf_user->hasCredential('can_edit_all_orders')
    or $sf_user->hasGroup('worker')
    or $sf_user->hasGroup('buhgalter')
  ):
?>
  <div class="btn-group">
    <a href="<?php echo url_for('@order-edit?id=' . $order->getId()) ?>" class="btn btn-primary">Редактировать</a>
  </div>
<?php endif ?>
<?php
  if (
    $sf_user->hasCredential('can_print_orders')
  ):
?>
  <div class="btn-group">
    <a href="<?php echo url_for('@order-print?id=' . $order->getId()) ?>" class="btn">Распечатать бланк заказа</a>
  </div>
<?php endif ?>
</div>

<?php
  if ($sf_user->hasGroup('buhgalter')):
?>
  <div class="btn-group">
      <a href="<?php echo url_for('@order-printaccount?id=' . $order->getId()) ?>" target="_blank" class="btn">Распечатать счет</a>
      <?php if($order->getSubmitedAt() != 0):?>
        <a href="<?php echo url_for('@order-printinvoice?id=' . $order->getId()) ?>" target="_blank" class="btn">Распечатать счет-фактуру</a>
        <a href="<?php echo url_for('@order-printwaybill?id=' . $order->getId()) ?>" target="_blank" class="btn">Распечатать ТТН</a>
      <?php endif;?>
  </div>
<?php endif;?>
<?php
  if ($sf_user->hasGroup('manager')):
?>
  <div class="btn-group">
      <a href="<?php echo url_for('@order-printaccount?id=' . $order->getId()) ?>" target="_blank" class="btn">Распечатать счет</a>
  </div>
<?php endif;?>
<?php
  if ($sf_user->hasGroup('worker')):
?>
  <div class="btn-group">
      <?php if($order->getSubmitedAt() != 0):?>
        <a href="<?php echo url_for('@order-printinvoice?id=' . $order->getId()) ?>" target="_blank" class="btn">Распечатать счет-фактуру</a>
        <a href="<?php echo url_for('@order-printwaybill?id=' . $order->getId()) ?>" target="_blank" class="btn">Распечатать ТТН</a>
      <?php endif;?>
  </div>
<?php endif;?>
<hr />

<h2>Комментарии</h2>
<?php if (true == ($comments = $order->getComments()) and count($comments)): ?>
<section class="comments row">
<?php foreach ($comments as $id => $comment): ?>
  <article class="comment<?php echo $comment->getReadAndMarkAsRead() ? '' : ' unread' ?> well span8" id="comment-<?php echo $comment->getId() ?>">
    <div class="meta clearfix muted">
      <div class="author pull-left"><?php echo $comment->getCreator() ?></div>
      <?php /* if ($comment->getCreatedBy() == $sf_user->getGuardUser()->getId()): ?>
        <a href="<?php echo url_for('@comment-delete?id=' . $comment->getId() . '&order=' . $order->getId())
          ?>" class="btn btn-mini pull-right"><i class="icon icon-remove"></i></a>
      <?php endif */ ?>
      <a href="#comment-<?php echo $comment->getId() ?>" class="date muted pull-right"><?php echo $comment->getCreatedAt() ?></a>
    </div>
    <div class="content">
      <?php echo simple_format_text($comment->getText()) ?>
    </div>
  </article>
<?php endforeach ?></section>
<?php else: ?>
<div class="alert alert-info">
  <strong></strong>
  Нет комментариев.
</div>
<?php endif ?>

<?php if (!$sf_user->hasGroup('monitor')): ?>
<form action="<?php echo url_for('@comment?id=' . $order->getId()) ?>" method="post" class="form-fluid">
<?php echo $commentForm->renderUsing('bootstrap') ?>
  <div class="form-actions">
    <button type="submit" class="btn btn-success">Комментировать</button>
  </div>
</form>
<?php endif ?>
