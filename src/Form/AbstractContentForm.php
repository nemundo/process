<?php


namespace Nemundo\Process\Form;


use Nemundo\Admin\Com\Form\AbstractAdminForm;
use Nemundo\Process\Content\AbstractContentType;

abstract class AbstractContentForm extends AbstractAdminForm
{

    /**
     * @var AbstractContentType
     */
    public $contentType;

    // editId
    // updateId
    public $dataId;




    public $parentId;

//    abstract protected function loadUpdateForm();


protected function loadUpdateForm() {

}


//    abstract protected function onSave();

    // onUpdate
//    abstract protected function onUpdate();


    public function getContent()
    {

        if ($this->dataId !== null) {
            $this->loadUpdateForm();
        }

        return parent::getContent();

    }


    /*
    final protected function onSubmit()
    {

        if ($this->dataId == null) {
            $this->onSave();
        } else {
            $this->onUpdate();
        }

    }

{*/

}