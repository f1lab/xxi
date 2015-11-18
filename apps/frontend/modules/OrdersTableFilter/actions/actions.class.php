<?php

/**
 * OrdersTableFilter actions.
 *
 * @package    xxi
 * @subpackage OrdersTableFilter
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrdersTableFilterActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->orders_table_filters = Doctrine_Query::create()
      ->from('OrdersTableFilter o')
      ->execute()
    ;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new OrdersTableFilterForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new OrdersTableFilterForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($orders_table_filter = Doctrine_Core::getTable('OrdersTableFilter')->find(array($request->getParameter('id'))), sprintf('Object orders_table_filter does not exist (%s).', $request->getParameter('id')));
    $this->form = new OrdersTableFilterForm($orders_table_filter);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($orders_table_filter = Doctrine_Core::getTable('OrdersTableFilter')->find(array($request->getParameter('id'))), sprintf('Object orders_table_filter does not exist (%s).', $request->getParameter('id')));
    $this->form = new OrdersTableFilterForm($orders_table_filter);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404Unless($orders_table_filter = Doctrine_Core::getTable('OrdersTableFilter')->find(array($request->getParameter('id'))), sprintf('Object orders_table_filter does not exist (%s).', $request->getParameter('id')));
    $orders_table_filter->delete();

    $this->redirect('orders/index');
  }

  public function executeAddNew(sfWebRequest $request) {
    $filterForm = new OrderFormFilter();
    $filterQuery = $request->getParameter($filterForm->getName());
    $filter = OrdersTableFilter::createFromArray([
      'user_id' => $this->getUser()->getGuardUser()->getId(),
      'is_default' => $request->getParameter('filter-is-default'),
      'name' => $request->getParameter('filter-name'),
      'filter' => $filterQuery,
    ]);
    $filter->save();
    $this->redirect('orders/index');
  }

  public function executeSetAsDefault(sfWebRequest $request)
  {
    $this->forward404Unless($orders_table_filter = Doctrine_Core::getTable('OrdersTableFilter')->find(array($request->getParameter('id'))), sprintf('Object orders_table_filter does not exist (%s).', $request->getParameter('id')));
    $orders_table_filter
      ->setIsDefault(true)
      ->setUpdatedAt(date('Y-m-d H:i:s'))
      ->save()
    ;

    $this->redirect('orders/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $orders_table_filter = $form->save();

      $this->redirect('OrdersTableFilter/edit?id='.$orders_table_filter->getId());
    }
  }
}
