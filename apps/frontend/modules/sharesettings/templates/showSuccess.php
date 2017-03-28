<table class="table  table-striped table-bordered">
    <tbody>
    <tr>
        <th>Количество позиций на первой странице ТТН:</th>
        <td><?php echo $share_settings->getWaybillCountPosOnFirstPage() ?></td>
        <td>Описание настройки: Количество позиций на первой странице после реквизитов. По умолчанию 7.Настройка
            предназначена для случаев длинного описания позиции.
        </td>
    </tr>
    <tr>
        <th>Количество позиций на полной странице ТТН:</th>
        <td><?php echo $share_settings->getWaybillCountPosOnFullPage() ?></td>
        <td>Описание настройки: Полная страница - страница полностью заполненная только пунктами заказа.По умолчанию
            15.Настройка предназначена для случаев большого количества пунктов в заказе.
        </td>
    </tr>
    <tr>
        <th>Количество позиций на последней странице ТТН с полями:</th>
        <td><?php echo $share_settings->getWaybillCountPosOnLastPage() ?></td>
        <td>Описание настройки: Количество позиций при которых вмещается подписи сторон.По умолчанию 5. Настройка
            предназначена для случаев большого количества пунктов в заказе.
        </td>

    </tr>
    <tr>
        <th>Текущий номер ТТН и Счет-фактуры:</th>
        <td><?php echo $share_settings->getWaybillCounter() ?></td>
        <td>Описание настройки: Текущий порядковый номер ТТН и Счет-фактуры.</td>
    </tr>
    </tbody>
</table>

<hr/>

<a class="btn" href="<?php echo url_for('sharesettings/edit?id=' . $share_settings->getId()) ?>">Редактировать</a>

