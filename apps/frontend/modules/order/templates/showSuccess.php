<div class="page-header">
  <h1>Заказ №<?php echo $order->getId() ?></h1>
</div>

<table class="table table-condensed table-bordered">
  <colgroup>
    <col class="span3" />
    <col />
  </colgroup>
  <tr>
    <th scope="row">Клиент</th>
    <td><?php echo $order->getClient() ?></td>
  </tr>
  <tr>
    <th scope="row">Описание заказа</th>
    <td><pre><?php echo $order->getDescription() ?></pre></td>
  </tr>
  <tr>
    <th scope="row">Срок исполнения</th>
    <td><?php echo $order->getDueDate() ?></td>
  </tr>
  <tr>
    <th scope="row">Дата согласования с заказчиком</th>
    <td><?php echo $order->getApprovedAt() ?></td>
  </tr>
  <tr>
    <th scope="row">Файлы и коментарии к ним</th>
    <td><pre><?php echo $order->getFiles() ?></pre></td>
  </tr>
  <tr>
    <th scope="row">Стоимость монтажа</th>
    <td><?php echo $order->getInstallationCost() ?></td>
  </tr>
  <tr>
    <th scope="row">Стоимость дизайна</th>
    <td><?php echo $order->getDesignCost() ?></td>
  </tr>
  <tr>
    <th scope="row">Стоимость работ подрядчиков</th>
    <td><?php echo $order->getContractorsCost() ?></td>
  </tr>
  <tr>
    <th scope="row">Стоимость работ</th>
    <td><?php echo $order->getCost() ?></td>
  </tr>
  <tr>
    <th scope="row">Дата поступления в работу</th>
    <td><?php echo $order->getStartedAt() ?></td>
  </tr>
  <tr>
    <th scope="row">Дата выполнения</th>
    <td><?php echo $order->getFinishedAt() ?></td>
  </tr>
  <tr>
    <th scope="row">Дата сдачи заказа</th>
    <td><?php echo $order->getSubmitedAt() ?></td>
  </tr>
  <tr>
    <th scope="row">Статус</th>
    <td><?php echo $order->getStateTranslated() ?></td>
  </tr>
</table>

<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('@order-edit?id=' . $order->getId()) ?>" class="btn btn-primary">Редактировать</a>
  </div>
</div>

<hr />

<h2>Комментарии</h2>
<?php if (true == ($comments = $order->getComments()) and isset($comments) and count($comments)):
use_helper('Text');
?>
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