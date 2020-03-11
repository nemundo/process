<?php


namespace Nemundo\Process\Content\Form;


use Nemundo\Admin\Com\Form\AbstractAdminForm;


// AbstractTreeContentForm
abstract class AbstractContentForm extends AbstractAdminForm
{

    use ContentFormTrait;

    public function getContent()
    {

        if ($this->contentType->existItem()) {
            $this->loadUpdateForm();
        }

        /*
        if (!$this->createMode) {
            $this->loadUpdateForm();
        }*/

        return parent::getContent();

    }

}