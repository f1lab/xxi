<?php

/**
 * Arrival form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArrivalForm extends BaseArrivalForm
{
    public function configure()
    {
        unset (
            $this['spent'],
            $this['deleted_at'],
            $this['created_at'],
            $this['updated_at'],
            $this['created_by'],
            $this['updated_by']
        );

        $this->getWidgetSchema()
            ->offsetSet('arrived_at', new sfWidgetFormBootstrapDate())
            ->setLabels([
                'arrived_at' => 'Дата поступления',
                'bill' => 'Накладная',
                'material_id' => 'Материал',
                'supplier_id' => 'Поставщик',
                'amount' => 'Количество',
                'price' => 'Цена за единицу',
            ]);

        $this->getWidgetSchema()
            ->offsetGet('material_id')
            ->setAttribute('class', 'chzn-select')
            ->setOption('add_empty', true)
            ->setOption('method', 'getNameWithDimension')
            ->setOption('query', Doctrine_Query::create()
                ->from('Material m')
                ->leftJoin('m.Dimension')
                ->addOrderBy('m.name')
            )
            ->getParent()
            ->offsetGet('supplier_id')
            ->setAttribute('class', 'chzn-select')
            ->setOption('add_empty', true)
            ->setOption('query', Doctrine_Query::create()
                ->from('Supplier s')
                ->addOrderBy('s.name')
            );
    }
}
