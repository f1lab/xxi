<?php

/**
 * OrdersTableSettings
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    xxi
 * @subpackage model
 * @author     Saritskiy Roman
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class OrdersTableSettings extends BaseOrdersTableSettings
{
  public function getColumnsForPartial() {
    $columns = $this->toArray();
    unset($columns['id'], $columns['user_id']);

    if (sfContext::getInstance()->getUser()->hasGroup('monitor')) {
      unset(
        $columns['client_id'],
        $columns['bill_made'],
        $columns['bill_given'],
        $columns['docs_given']
      );
    }

    $columns = array_keys(array_filter($columns));

    return array_map(function($column) {
      return str_replace('_enabled', '', $column);
    }, $columns);
  }
}