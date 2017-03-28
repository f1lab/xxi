<?php

/**
 * arrival actions.
 *
 * @package    xxi
 * @subpackage arrival
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class arrivalActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $query = Doctrine_Query::create()
            ->from('Arrival a');

        if ($request->hasParameter('material_id')) {
            $query->addWhere('a.material_id = ?', $request->getParameter('material_id'));
        }

        $this->arrivals = $query->execute();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new ArrivalForm();

        if ($request->hasParameter('supplier_id')) {
            $this->form
                ->setDefaults([
                    'supplier_id' => $request->getParameter('supplier_id'),
                ])
                ->getWidgetSchema()
                ->offsetSet('supplier_id', new sfWidgetFormInputHidden());
        }
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ArrivalForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($arrival = Doctrine_Core::getTable('Arrival')->find([$request->getParameter('id')]),
            sprintf('Object arrival does not exist (%s).', $request->getParameter('id')));
        $this->form = new ArrivalForm($arrival);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($arrival = Doctrine_Core::getTable('Arrival')->find([$request->getParameter('id')]),
            sprintf('Object arrival does not exist (%s).', $request->getParameter('id')));
        $this->form = new ArrivalForm($arrival);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($arrival = Doctrine_Core::getTable('Arrival')->find([$request->getParameter('id')]),
            sprintf('Object arrival does not exist (%s).', $request->getParameter('id')));
        $arrival->delete();

        $this->redirect('arrival/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $arrival = $form->save();

            $this->redirect('arrival/edit?id=' . $arrival->getId());
        }
    }

    public function executeImport($request)
    {
        $this->form = new ImportForm();
        $this->form->getWidgetSchema()
            ->offsetSet('supplier_id', new sfWidgetFormDoctrineChoice(['model' => 'Supplier', 'add_empty' => false],
                ['class' => 'chzn-select']))
            ->offsetSet('amount', new sfWidgetFormInputText())
            ->setLabels([
                'input' => 'Поступления',
                'supplier_id' => 'Поставщик',
                'amount' => 'Количество',
            ]);
        $this->form->getValidatorSchema()
            ->offsetSet('supplier_id', new sfValidatorPass())
            ->offsetSet('amount', new sfValidatorPass());

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()),
                $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $submited = $this->form->getValues();
                $arrivals = new Doctrine_Collection('Arrival');
                $bill = 1;

                $import = array_unique(explode("\n", $submited['input']));

                array_walk($import, function ($line) use (&$bill, &$arrivals, $submited) {
                    $parts = explode("\t", $line);
                    $parted = explode(",", $parts[0]);
                    /* $dimension = */
                    array_pop($parted);

                    if (true == ($material = Doctrine_Core::getTable('Material')->findOneByName(join(",", $parted)))) {
                        $arrivals->add(Arrival::createFromArray([
                            "arrived_at" => date("Y-m-d H:i:s"),
                            "bill" => $bill++,
                            "supplier_id" => $submited["supplier_id"],
                            "material_id" => $material->getId(),
                            "amount" => $submited["amount"],
                            "price" => array_pop($parts),
                        ]));
                    }
                });
                $arrivals->save();

                $this->getUser()->setFlash('flash', [
                    'type' => 'success',
                    'message' => 'Данные загружены',
                ]);

                //$this->redirect('arrival/index');
            }
        }
    }
}
