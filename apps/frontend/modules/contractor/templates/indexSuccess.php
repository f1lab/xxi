<div class="page-header">
    <h1>Подрядчики</h1>
</div>

<div class="btn-toolbar">
    <?php if ($sf_user->hasGroup('director') or $sf_user->hasCredential('can_edit_contractors')): ?>
        <div class="btn-group">
            <a href="<?php echo url_for('@contractor-new') ?>" class="btn btn-primary">Добавить</a>
        </div>
    <?php endif ?>
    <div class="btn-group">
        <select name="" id="" style="float:left;margin-bottom:0"
                onchange="document.location.href = '<?php echo url_for('@contractors') ?>/' + $(this).val()"
                class="chzn-select" data-placeholder="Быстрый переход">
            <option value=""></option>
            <?php foreach ($clients as $client): ?>
                <option value="<?php echo $client->getId() ?>"><?php echo $client ?></option>
            <?php endforeach ?></select>
    </div>
</div>

<table class="table table-condensed table-bordered rows-clickable">
    <thead>
    <tr>
        <th>#</th>
        <th>Краткое наименование</th>
        <th>Контактное лицо</th>
        <th>Телефон</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody><?php foreach ($clients as $client): ?>
        <tr>
            <td><?php echo $client->getId() ?></td>
            <td><a href="<?php echo url_for('@contractor?id='
                    . $client->getId()) ?>"><?php echo $client->getName() ?></a></td>
            <td><?php echo $client->getContact() ?></td>
            <td><?php echo $client->getPhone() ?></td>
            <td><?php echo $client->getEmail() ?></td>
        </tr>
    <?php endforeach ?></tbody>
</table>
