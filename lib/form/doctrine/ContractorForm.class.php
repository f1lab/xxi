<?php

/**
 * Contractor form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContractorForm extends BaseContractorForm
{
    public function configure()
    {
        unset (
            $this['deleted_at']
        );

        $this->getWidgetSchema()->setLabels([
            'name' => 'Наименование организации',
            'contact' => 'Контактное лицо',
            'phone' => 'Телефон',
            'email' => 'Email',
            'full_name' => 'Полное наименование',
            'ownership' => 'Форма собственности',
            'address_jure' => 'Юридический адрес',
            'inn' => 'ИНН',
            'kpp' => 'КПП',
            'rs' => 'Расчётный счёт',
            'bank' => 'Наименование и адрес банка',
            'bik' => 'БИК',
            'ks' => 'Корр. счёт',
            'ogrn' => 'ОГРН',
            'okpo' => 'ОКПО',
            'discount' => 'Скидка, %',
            'buhgalter' => 'ФИО бухгалтера',
            'buhgalter_phone' => 'Телефон бухгалтера',
        ]);

        $this->getValidatorSchema()->offsetSet('email', new sfValidatorEmail(['required' => false]));
    }
}
