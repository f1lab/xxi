<?php

/**
 * MaterialMovementMaterials form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MaterialMovementMaterialsForm extends BaseMaterialMovementMaterialsForm
{
    public function configure()
    {
        unset (
            $this['deleted_at']
            , $this['created_at']
            , $this['updated_at']
            , $this['created_by']
            , $this['updated_by']
        );
    }
}
