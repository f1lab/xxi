<?php
use_helper('Text');

function pageLink($page)
{
    static $request = false;
    if (!$request) {
        $request = sfContext::getInstance()->getRequest();
    }

    return url_for2(
        'orders',
        array_merge($request->getParameterHolder()->getAll(), ['page' => $page])
    );
}

?>

<?php
if (
    (
        isset($pager) && true == ($orders = $sf_data->getRaw('pager')->getResults())
        or isset($orders) && true == ($orders = $sf_data->getRaw('orders'))
    ) and count($orders) and true == ($columns = $sf_data->getRaw('columns'))
):
    ?>
    <table class="table table-condensed table-bordered rows-clickable">
        <thead>
        <tr>
            <?php if (in_array('id', $columns)): ?>
                <th>#</th><?php endif ?>
            <?php if (in_array('client_id', $columns)): ?>
                <th>Заказчик</th><?php endif ?>
            <?php if (in_array('approved_at', $columns)): ?>
                <th data-sorter="shortDate">Согласовано</th><?php endif ?>
            <?php if (in_array('due_date', $columns)): ?>
                <th data-sorter="shortDate">Срок исполнения</th><?php endif ?>
            <?php if (in_array('submited_at', $columns)): ?>
                <th data-sorter="shortDate">Дата сдачи</th><?php endif ?>
            <?php if (in_array('state', $columns)): ?>
                <th>Статус</th><?php endif ?>
            <?php if (in_array('cost', $columns)): ?>
                <th>Стоимость</th><?php endif ?>
            <?php if (in_array('payed', $columns)): ?>
                <th>Внесено</th><?php endif ?>
            <?php if (in_array('pay_method', $columns)): ?>
                <th>Способ оплаты</th><?php endif ?>
            <?php if (in_array('payed_at', $columns)): ?>
                <th data-sorter="shortDate">Дата оплаты</th><?php endif ?>
            <?php if (in_array('manager', $columns)): ?>
                <th>Менеджер</th><?php endif ?>
            <?php if (in_array('bill_made', $columns)): ?>
                <th>Счёт сф.</th><?php endif ?>
            <?php if (in_array('bill_given', $columns)): ?>
                <th>Счёт пол.</th><?php endif ?>
            <?php if (in_array('docs_given', $columns)): ?>
                <th>Док-ты выданы</th><?php endif ?>
            <?php if (in_array('comments', $columns)): ?>
                <th title="Комментарии"></th><?php endif ?>
        </tr>
        </thead>
        <tbody><?php foreach ($orders as $order): ?>
            <tr
                    rel="popover"
                    data-placement="top"
                    data-title="Описание заказа"
                    data-content="<?php echo simple_format_text(str_replace('"', '&quot;',
                        $order->getDescription())) ?>"
                    class="<?php echo $order->getColorIndicator() ?>"
            >
                <?php if (in_array('id', $columns)): ?>
                    <td><a
                            href="<?php echo url_for('@order?id='
                                . $order->getId()) ?>"><?php echo $order->getId() ?></a>
                    </td><?php endif ?>
                <?php if (in_array('client_id', $columns)): ?>
                    <td><?php echo $order->getClient() ?></td><?php endif ?>
                <?php if (in_array('approved_at', $columns)): ?>
                    <td><?php echo $order->getApprovedAt() ? date('d-m-Y', strtotime($order->getApprovedAt()))
                        : '' ?></td><?php endif ?>
                <?php if (in_array('due_date', $columns)): ?>
                    <td><?php echo $order->getDueDate() ? date('d-m-Y', strtotime($order->getDueDate()))
                        : '' ?></td><?php endif ?>
                <?php if (in_array('submited_at', $columns)): ?>
                    <td><?php echo $order->getSubmitedAt() ? date('d-m-Y', strtotime($order->getSubmitedAt()))
                        : '' ?></td><?php endif ?>
                <?php if (in_array('state', $columns)): ?>
                    <td><?php echo $order->getStateTranslated() ?></td><?php endif ?>
                <?php if (in_array('cost', $columns)): ?>
                    <td><?php echo $order->getCost() ?></td><?php endif ?>
                <?php if (in_array('payed', $columns)): ?>
                    <td><?php echo $order->getPayed() ?></td><?php endif ?>
                <?php if (in_array('pay_method', $columns)): ?>
                    <td><?php echo $order->getPayMethodTranslated() ?></td><?php endif ?>
                <?php if (in_array('payed_at', $columns)): ?>
                    <td><?php echo $order->getPayedAt() ? date('d-m-Y', strtotime($order->getPayedAt()))
                        : '' ?></td><?php endif ?>
                <?php if (in_array('manager', $columns)): ?>
                    <td><?php echo $order->getCreator()->getFirstName() . ' ' . $order->getCreator()
                            ->getLastName() ?></td><?php endif ?>
                <?php if (in_array('bill_made', $columns)): ?>
                    <td><input type="checkbox" readonly<?php echo $order->getBillMade() ? ' checked' : '' ?>>
                    </td><?php endif ?>
                <?php if (in_array('bill_given', $columns)): ?>
                    <td><input type="checkbox" readonly<?php echo $order->getBillGiven() ? ' checked' : '' ?>>
                    </td><?php endif ?>
                <?php if (in_array('docs_given', $columns)): ?>
                    <td><input type="checkbox" readonly<?php echo $order->getDocsGiven() ? ' checked' : '' ?>>
                    </td><?php endif ?>
                <?php if (in_array('comments', $columns)):
                    $comments = $order->getComments()->count();
                    $commentsRead = array_reduce($order->getComments()->toArray(), function ($return, $item) {
                        if ($item['read'] > 0) {
                            $return++;
                        }

                        return $return;
                    });
                    ?>
                    <td><span class="badge<?php echo $comments > $commentsRead ? ' badge-warning' : '' ?>"
                              title="<?php echo $comments - $commentsRead ?> unread"><?php echo $comments ?></span></td>
                <?php endif ?>
            </tr>
        <?php endforeach ?></tbody>
    </table>

    <?php if (isset($pager) and $pager->haveToPaginate()): ?>
    <div class="pagination pagination-centered">
        <ul>
            <li<?php echo ($pager->getPreviousPage() == $pager->getPage()) ? ' class="active"' : '' ?>>
                <a href="<?php echo pageLink($pager->getPreviousPage()) ?>">&lt;</a>
            </li>
            <?php foreach ($pager->getLinks() as $page): ?>
                <li<?php echo ($page == $pager->getPage()) ? ' class="active"' : '' ?>>
                    <a href="<?php echo pageLink($page) ?>"><?php echo $page ?></a>
                </li>
            <?php endforeach; ?>
            <li<?php echo ($pager->getNextPage() == $pager->getPage()) ? ' class="active"' : '' ?>>
                <a href="<?php echo pageLink($pager->getNextPage()) ?>">&gt;</a>
            </li>
        </ul>
    </div>
<?php endif ?>

<?php else: ?>
    <div class="alert alert-info"><strong>Нет заказов</strong>.</div>
<?php endif ?>
