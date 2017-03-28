<?php

/**
 * material actions.
 *
 * @package    xxi
 * @subpackage material
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class materialActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->materials = Doctrine_Core::getTable('Material')
            ->createQuery('a, a.Dimension')
            ->addOrderBy('a.name')
            ->execute();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new MaterialForm();
        if ($request->hasParameter('client')) {
            $this->form->setDefaults([
                'suppliers_list' => (array)$request->getParameter('client'),
            ]);
        }
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->material = Doctrine_Core::getTable('Material')->find($request->getParameter('id'));
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new MaterialForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($material = Doctrine_Core::getTable('Material')->find([$request->getParameter('id')]),
            sprintf('Object material does not exist (%s).', $request->getParameter('id')));
        $this->form = new MaterialForm($material);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($material = Doctrine_Core::getTable('Material')->find([$request->getParameter('id')]),
            sprintf('Object material does not exist (%s).', $request->getParameter('id')));
        $this->form = new MaterialForm($material);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($material = Doctrine_Core::getTable('Material')->find([$request->getParameter('id')]),
            sprintf('Object material does not exist (%s).', $request->getParameter('id')));
        $material->delete();

        $this->redirect('material/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $material = $form->save();

            $this->redirect($request->hasParameter('client') ? '@supplier?id=' . $request->getParameter('client')
                : 'material/edit?id=' . $material->getId());
        }
    }

    public function executeImport($request)
    {
        $this->form = new ImportForm();

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()),
                $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $submited = $this->form->getValues();
                $dimensions = [];
                $materials = new Doctrine_Collection('Material');

                $import = array_unique(explode("\n", $submited['input']));
                array_walk($import, function ($line) use (&$dimensions, &$materials) {
                    $parted = explode(",", $line);
                    $dimension = array_pop($parted);

                    if (true == (Doctrine_Core::getTable('Material')->findOneByName(join(",", $parted)))) {
                        //
                    } else {
                        if (!array_key_exists($dimension, $dimensions)) {
                            if (true == ($newDimension = Doctrine_Core::getTable('Dimension')
                                    ->findOneByName($dimension))
                            ) {
                                //
                            } else {
                                $newDimension = Dimension::createFromArray([
                                    "name" => $dimension,
                                ]);
                                $newDimension->save();
                            }

                            $dimensions[$dimension] = $newDimension->getId();
                        }

                        $materials->add(Material::createFromArray([
                            "name" => join(",", $parted),
                            "dimension_id" => $dimensions[$dimension],
                        ]));
                    }
                });

                $materials->save();

                $this->getUser()->setFlash('flash', [
                    'type' => 'success',
                    'message' => 'Данные загружены',
                ]);

                $this->redirect('material/index');
            }
        }
    }

    public function executeAdd($request)
    {
        $form = new MaterialForm();
        $form->disableCSRFprotection();
        unset($form["_csrf_token"]);

        $form->bind([
            "name" => $request->getParameter("name"),
            "dimension_id" => $request->getParameter("dimension_id"),
        ]);

        try {
            $form->save();
            $this->getResponse()->setStatusCode(200);
        } catch (\Exception $e) {
            $this->getResponse()->setStatusCode(400);
        }

        $this->getResponse()->setHeaderOnly(true);

        return sfView::NONE;
    }

    public function executeDump($request)
    {
        $materials = Doctrine_Query::create()
            ->from("Material m")
            ->leftJoin('m.Dimension d')
            ->select("m.id, m.name")
            ->addOrderBy("m.name asc")
            ->execute([]);

        die (json_encode(array_map(function ($material) {
            return [$material->getId(), $material->getNameWithDimension()];
        }, $materials->getData()), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
