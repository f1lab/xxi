<?php

/**
 * Comment form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Anatoly Pashin
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommentForm extends BaseCommentForm
{
    public function configure()
    {
        unset($this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by']);

        $this->getWidgetSchema()->offsetSet('order_id', new sfWidgetFormInputHidden());
        $this->getWidgetSchema()->setLabels([
            'text' => 'Комментарий',
        ]);
    }
}
