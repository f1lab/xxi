<?php

/**
 * ShareSettings form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ShareSettingsForm extends BaseShareSettingsForm
{
    public function configure()
    {
        $this
            ->getWidgetSchema()
            ->setLabels([
                'waybill_count_pos_on_first_page' => 'Количество позиций на первой странице ТТН:',
                'waybill_count_pos_on_full_page' => 'Количество позиций на полной странице ТТН:',
                'waybill_count_pos_on_last_page' => 'Количество позиций на последней странице ТТН с полями:',
                'waybill_counter' => 'Текущий номер ТТН и Счет-фактуры:',
            ]);
    }
}
