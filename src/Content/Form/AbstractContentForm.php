<?php


namespace Nemundo\Process\Content\Form;


use Nemundo\Admin\Com\Form\AbstractAdminForm;


// AbstractTreeContentForm
abstract class AbstractContentForm extends AbstractAdminForm
{

    use ContentFormTrait;

    public function getContent()
    {

        if (!$this->createMode) {
            $this->loadUpdateForm();
        }

        return parent::getContent();

    }

}