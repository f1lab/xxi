<?php use_helper('Text') ?>

<ul class="pager pull-right"><?php
  $version = $order['version'];
  $cantclick1 = $cantclick2 = false;
?>
  <li <?php if ($version-1 < 1):
    $cantclick1 = true;
    echo ' class="disabled"';
  endif ?>>
    <a href="<?php echo ($cantclick1 ? '#' : '') . url_for('@order?id=' . $order->getId() . '&version=' . ($version-1))
      ?>">← версия <?php echo $version-1 ?></a>
  </li>
  <li class="active">
    версия <?php echo $version ?> от <?php echo $order->getUpdator()->getUsername() ?> от <?php echo $order->getUpdatedAt() ?>
  </li>
  <li <?php if ($order->getAuditLog()->getMaxVersion($sf_data->getRaw('order')) == $version):
    $cantclick2 = true;
    echo ' class="disabled"';
  endif ?>>
    <a href="<?php echo ($cantclick2 ? '#' : '') . url_for('@order?id=' . $order->getId() . '&version=' . ($version+1))
      ?>">версия <?php echo $version+1 ?>→</a>
  </li>
</ul>

<div class="page-header">
  <h1>Заказ №<?php echo $order->getId() ?></h1>
</div>

<div class="tabbable" style="margin-top: 2em;">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab-description" data-toggle="tab">Описание заказа</a></li>
    <li><a href="#tab-utilization" data-toggle="tab">Расход материалов</a></li>
    <li><a href="#tab-works" data-toggle="tab">Работы</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab-description">
      <?php include_partial('order-description-tab', ['order' => $order, 'fields' => $fields]) ?>
    </div>
    <div class="tab-pane" id="tab-utilization">
      <?php include_partial('order-utilization-tab', ['order' => $order, 'utilizations' => $utilizations]) ?>
    </div>
    <div class="tab-pane" id="tab-works">
      <?php include_partial('order-works-tab', ['order' => $order]) ?>
    </div>
  </div>
</div>

<div class="btn-toolbar">
  <?php
    if ( //TODO: replace this mess with some permission or move this check to model
      $sf_user->hasGroup('manager')
        && $order->getCreatedBy() == $sf_user->getGuardUser()->getId()
        && in_array($order->getState(), ['calculating', 'prepress', 'prepress-done', 'work', 'working'])
      or $sf_user->hasCredential('can_edit_all_orders')
      or $sf_user->hasGroup('worker')
      or $sf_user->hasGroup('buhgalter')
      or $sf_user->hasGroup("design-worker")
    ):
  ?>
    <div class="btn-group">
      <a href="<?php echo url_for('@order-edit?id=' . $order->getId()) ?>" class="btn btn-primary">Редактировать</a>
    </div>
  <?php endif ?>

  <?php if ($sf_user->hasCredential("can-delete_orders")): ?>
    <div class="btn-group">
      <a href="<?php echo url_for("order/delete?id=" . $order->getId()) ?>" class="btn btn-warning confirm">Удалить</a>
    </div>
  <?php endif ?>

  <?php if ($sf_user->hasCredential('can_print_orders')): ?>
    <div class="btn-group">
      <a href="<?php echo url_for('@order-print?id=' . $order->getId()) ?>" class="btn">Распечатать бланк заказа (цех)</a>
    </div>
  <?php endif ?>

  <?php if ($sf_user->hasCredential(["can-print-design-orders", "design-worker"], false)): //false is for OR switch ?>
    <div class="btn-group">
      <a href="<?php echo url_for('@order-print-design?id=' . $order->getId()) ?>" class="btn">Распечатать бланк заказа (дизайн/препресс)</a>
    </div>
  <?php endif ?>

  <div class="" style="margin-left: 100px; display: inline-block;"> </div>

  <?php if ($sf_user->hasGroup('manager') or $sf_user->hasGroup('buhgalter')): ?>
    <div class="btn-group">
      <a href="<?php echo url_for('@order-printaccount?id=' . $order->getId()) ?>" target="_blank" class="btn">Распечатать счет</a>
    </div>
  <?php endif ?>

  <?php if ($sf_user->hasGroup('buhgalter') || $sf_user->hasGroup('worker') and $order->getSubmitedAt()): ?>
    <div class="btn-group">
      <a href="<?php echo url_for('@order-printinvoice?id=' . $order->getId()) ?>" target="_blank" class="btn">Распечатать счет-фактуру</a>
      <a href="<?php echo url_for('@order-printwaybill?id=' . $order->getId()) ?>" target="_blank" class="btn">Распечатать ТТН</a>
    </div>
  <?php endif ?>
</div>

<h2 class="page-header">Комментарии</h2>
<?php if (true == ($comments = $order->getComments()) and count($comments)): ?>
  <section class="comments row"><?php foreach ($comments as $id => $comment): ?>
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
