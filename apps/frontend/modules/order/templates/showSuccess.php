<?php use_helper('Text') ?>
<div class="page-header">
  <h1>Заказ №<?php echo $order->getId() ?></h1>
</div>

<table class="table table-condensed table-bordered">
  <colgroup>
    <col class="span3" />
    <col />
  </colgroup>
<?php foreach ($fields as $field=>$label): $field = 'get' . ucfirst($field); ?>
  <tr>
    <th scope="row"><?php echo $label ?></th>
    <td><?php
    if ($field == 'getDescription' or $field == 'getFiles') {
      echo simple_format_text($order->$field());
    } else {
      echo $order->$field();
    }
    ?></td>
  </tr>
<?php endforeach ?>
</table>

<?php
  if ( //TODO: replace this mess with some permission or move this check to model
    $sf_user->hasGroup('manager') && $order->getCreatedBy() == $sf_user->getGuardUser()->getId()
    or $sf_user->hasCredential('can_edit_all_orders')
    or $sf_user->hasGroup('worker')
    or $sf_user->hasGroup('buhgalter')
  ):
?>
<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('@order-edit?id=' . $order->getId()) ?>" class="btn btn-primary">Редактировать</a>
  </div>
</div>
<?php endif ?>

<hr />

<h2>Комментарии</h2>
<?php if (true == ($comments = $order->getComments()) and count($comments)): ?>
<section class="comments row">
<?php foreach ($comments as $id=>$comment): ?>
  <article class="comment well span6" id="comment-<?php echo $comment->getId() ?>">
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

<form action="<?php echo url_for('@comment?id=' . $order->getId()) ?>" method="post" class="form-fluid">
<?php echo $commentForm->renderUsing('bootstrap') ?>
  <div class="form-actions">
    <button type="submit" class="btn btn-success">Комментировать</button>
  </div>
</form>