<?php if (count($filters) > 0): ?>
    <div class="well">
        <form class="form-horizontal submit-on-select-change" method="get">
            <div class="control-group">
                <div class="control-label">
                    Сохранённый фильтр
                </div>
                <div class="controls">
                    <select name="filter_id" class="chzn-select" data-placeholder="Выберите">
                        <option value=""></option>
                        <?php foreach ($filters as $filter): ?>
                            <option
                                    value="<?php echo $filter->getId() ?>" <?php if ($currentFilter !== null
                                and $currentFilter->getId() === $filter->getId()
                            ) echo 'selected' ?>>
                                <?php echo $filter ?>
                            </option>
                        <?php endforeach ?></select>
                </div>
            </div>

            <?php if ($currentFilter !== null): ?>
                <div class="control-group">
                    <div class="controls">
                        <a href="<?php echo url_for('OrdersTableFilter/setAsDefault?id=' . $currentFilter->getId()); ?>"
                           class="btn">Сделать фильтром по-умолчанию</a>
                        <a href="<?php echo url_for('OrdersTableFilter/delete?id=' . $currentFilter->getId()); ?>"
                           class="btn confirm">Удалить фильтр</a>
                    </div>
                </div>
            <?php endif ?>
        </form>
    </div>
<?php endif ?>

<form action="<?php echo url_for('@orders') ?>" method="get" class="well form-horizontal">

    <div class="control-group<?php if ($form['client_id']->hasError()): ?> error<?php endif ?>">
        <?php echo $form['client_id']->renderLabel(null, ['class' => 'control-label']) ?>
        <div class="controls">
            <?php echo $form['client_id']->render() ?>
            <?php if ($form['client_id']->hasError()): ?>
                <div class="help-inline"><?php echo $form['client_id']->getError() ?></div><?php endif ?>
        </div>
    </div>

    <div class="control-group<?php if ($form['created_by']->hasError()): ?> error<?php endif ?>">
        <?php echo $form['created_by']->renderLabel(null, ['class' => 'control-label']) ?>
        <div class="controls">
            <?php echo $form['created_by']->render() ?>
            <?php if ($form['created_by']->hasError()): ?>
                <div class="help-inline"><?php echo $form['created_by']->getError() ?></div><?php endif ?>
        </div>
    </div>

    <?php foreach (OrderFormFilter::$attributesWithTimestamps as $attribute): ?>
        <div class="control-group<?php if ($form[$attribute . "_at_from"]->hasError()): ?> error<?php endif ?>">
            <?php echo $form[$attribute . "_at_from"]->renderLabel(null, ['class' => 'control-label']) ?>
            <div class="controls form-horizontal">
                <?php echo $form[$attribute . "_at_from"]->render(['placeholder' => 'from']) ?>
                <?php echo $form[$attribute . "_at_to"]->render(['placeholder' => 'to']) ?>
                <?php if ($form[$attribute . "_at_from"]->hasError()): ?>
                    <div
                            class="help-inline"><?php echo $form[$attribute
                    . "_at_from"]->getError() ?></div><?php endif ?>
            </div>
        </div>
    <?php endforeach ?>

    <div class="control-group<?php if ($form['pay_method']->hasError()): ?> error<?php endif ?>">
        <?php echo $form['pay_method']->renderLabel(null, ['class' => 'control-label']) ?>
        <div class="controls">
            <?php echo $form['pay_method']->render() ?>
            <?php if ($form['pay_method']->hasError()): ?>
                <div class="help-inline"><?php echo $form['pay_method']->getError() ?></div><?php endif ?>
        </div>
    </div>

    <div class="control-group<?php if ($form['has_payments_from']->hasError()): ?> error<?php endif ?>">
        <?php echo $form['has_payments_from']->renderLabel(null, ['class' => 'control-label']) ?>
        <div class="controls form-horizontal">
            <?php echo $form['has_payments_from']->render(['placeholder' => 'from']) ?>
            <?php echo $form['has_payments_to']->render(['placeholder' => 'to']) ?>
            <?php if ($form['has_payments_from']->hasError()): ?>
                <div
                        class="help-inline"><?php echo $form['has_payments_from']->getError() ?></div><?php endif ?>
        </div>
    </div>

    <div class="control-group<?php if ($form['state']->hasError()): ?> error<?php endif ?>">
        <?php echo $form['state']->renderLabel(null, ['class' => 'control-label']) ?>
        <div class="controls form-horizontal">
            <?php echo $form['state']->render() ?>
            <?php if ($form['state']->hasError()): ?>
                <div class="help-inline"><?php echo $form['state']->getError() ?></div><?php endif ?>
             <a href="#" onclick="return resetNearestSelect(this)" class="muted">очистить</a>
        </div>
    </div>

    <div class="control-group<?php if ($form['area']->hasError()): ?> error<?php endif ?>">
        <?php echo $form['area']->renderLabel(null, ['class' => 'control-label']) ?>
        <div class="controls">
            <?php echo $form['area']->render() ?>
            <?php if ($form['area']->hasError()): ?>
                <div class="help-inline"><?php echo $form['area']->getError() ?></div><?php endif ?>
        </div>
    </div>

    <div class="control-group<?php if ($form['bill_made']->hasError()): ?> error<?php endif ?>">
        <?php echo $form['bill_made']->renderLabel(null, ['class' => 'control-label']) ?>
        <div class="controls">
            <?php echo $form['bill_made']->render() ?>
            <?php if ($form['bill_made']->hasError()): ?>
                <div class="help-inline"><?php echo $form['bill_made']->getError() ?></div><?php endif ?>
        </div>
    </div>

    <div class="control-group<?php if ($form['bill_given']->hasError()): ?> error<?php endif ?>">
        <?php echo $form['bill_given']->renderLabel(null, ['class' => 'control-label']) ?>
        <div class="controls">
            <?php echo $form['bill_given']->render() ?>
            <?php if ($form['bill_given']->hasError()): ?>
                <div class="help-inline"><?php echo $form['bill_given']->getError() ?></div><?php endif ?>
        </div>
    </div>

    <div class="control-group<?php if ($form['docs_given']->hasError()): ?> error<?php endif ?>">
        <?php echo $form['docs_given']->renderLabel(null, ['class' => 'control-label']) ?>
        <div class="controls">
            <?php echo $form['docs_given']->render() ?>
            <?php if ($form['docs_given']->hasError()): ?>
                <div class="help-inline"><?php echo $form['docs_given']->getError() ?></div><?php endif ?>
        </div>
    </div>

    <?php if (
        $sf_user->hasGroup("worker") || $sf_user->hasGroup("design-worker")
        or $sf_user->hasCredential(["orders-filter-works-without", "order-filter-works-completed"])
    ): ?>
        <div class="control-group<?php if ($form['works_list']->hasError()): ?> error<?php endif ?>">
            <?php echo $form['works_list']->renderLabel(null, ['class' => 'control-label']) ?>
            <div class="controls">
                <?php echo $form['works_list']->render() ?>
                <?php if ($form['works_list']->hasError()): ?>
                    <div class="help-inline"><?php echo $form['works_list']->getError() ?></div><?php endif ?>
            </div>
        </div>
    <?php endif ?>

    <?php $form->renderHiddenFields() ?>

    <?php if ($sf_request->getParameter($form->getName())): ?>
        <input type="hidden" name="filter-name" id="filter-saver-name">
        <input type="hidden" name="filter-is-default" id="filter-saver-is-default">
        <button type="submit" class="btn addNewOrdersTableFilter">Сохранить как новый фильтр</button>
    <?php endif ?>

    <button type="submit" class="btn btn-primary">Отфильтровать</button>
    <a href="<?php echo url_for('@orders') ?>" class="btn">Отменить</a>
</form>
