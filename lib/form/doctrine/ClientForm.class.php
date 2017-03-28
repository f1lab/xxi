<?php

/**
 * Client form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Anatoly Pashin
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClientForm extends BaseClientForm
{
    public function configure()
    {
        unset($this['created_by'], $this['updated_by'], $this['deleted_at'], $this['ownership']);

        $this->getWidgetSchema()
            ->offsetSet('name', new sfWidgetFormInputText([], ['placeholder' => 'Ф1 Лаб']))
            // ->offsetSet('ownership', new sfWidgetFormChoice(array(
            // 'choices' => ClientTable::$ownership,
            // )))
            ->setLabels([
                'is_blacklisted' => 'В чёрном списке?',
                'credit_line' => 'Кредитная линия',
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
