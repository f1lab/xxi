<?php
/**
 * @var Order $order
 * @var string[] $fields
 */
?>
<table class="table table-condensed table-bordered">
    <colgroup>
        <col class="span3"/>
        <col/>
    </colgroup>
    <?php foreach ($fields as $field => $label):
        $user = sfContext::getInstance()->getUser();
        if (
            in_array($field, [
                'installationCost',
                'designCost',
                'contractorsCost',
                'deliveryCost',
                'cost',
                'recoil',
            ], true)
            && !$user->hasCredential(\sfGuardPermissionTable::CAN_VIEW_COSTS)
            && !$user->hasCredential(\sfGuardPermissionTable::CAN_EDIT_COSTS)
        ) {
            continue;
        }

        $field = 'get' . ucfirst($field);
        ?>
        <tr>
            <th scope="row"><?php echo $label ?></th>
            <td><?php
                if (in_array($field, [
                    'getDescription',
                    'getAdditional',
                    'getFiles',
                ])) {
                    echo simple_format_text($order->$field());
                } elseif (in_array($field, [
                    'getApprovedAt',
                    'getPayedAt',
                    'getStartedAt',
                    'getFinishedAt',
                    'getSubmitedAt',
                ])) {
                    echo $order->$field()
                        ? date('d.m.Y', strtotime($order->$field()))
                        : '';
                } elseif (in_array($field, [
                    'getDueDate',
                    'getExpectedAt',
                ])) {
                    echo $order->$field()
                        ? date('d.m.Y H:i', strtotime($order->$field()))
                        : '';
                } elseif ($field == 'getClientFullestName') {
                    echo '<a href="' . url_for('@client?id=' . $order->getClient()->getId()) . '">' . $order->$field()
                        . '</a>';
                } elseif (in_array($field, [
                    'getBillMade',
                    'getBillGiven',
                    'getDocsGiven',
                ])) {
                    echo $order->$field() ? 'Да' : 'Нет';
                } else {
                    echo $order->$field();
                }
                ?></td>
        </tr>
    <?php endforeach ?>
</table>
