<?php

/**
 * CompanySettings form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CompanySettingsForm extends BaseCompanySettingsForm
{
  public function configure()
  {
    unset(
      $this['created_by'],
      $this['created_at'],
      $this['updated_by'],
      $this['updated_at'],
      $this['deleted_at']
    );
    $this
      ->getWidgetSchema()
            ->setLabels(array(
              'name' => 'Наименование',
              'full_name' => 'Полное наименование',
              'phone' => 'Телефон',
              'address_jure' => 'Юр.Адрес',
              'inn' => 'Инн',
              'kpp' => 'Кпп',
              'rs' => 'Рс',
              'bank' => 'Банк',
              'bik' => 'Бик',
              'ks' => 'Кс',
              'ogrn' => 'Огрн',
              'okpo' => 'Окпо',
              'buhgalter' => 'Гл.Бухгалтер',
              'director' => 'Директор',
            ))
    ;

  }
}
