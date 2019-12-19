<?php


namespace Nemundo\Process\Content\Form;


use Nemundo\Admin\Com\Form\AbstractAdminForm;
use Nemundo\Html\Paragraph\Paragraph;

abstract class AbstractContentForm extends AbstractAdminForm
{

    use ContentFormTrait;

    public function getContent()
    {

        /*
        $p = new Paragraph($this);
        $p->content = 'parentid'.$this->parentId;

        $p = new Paragraph($this);
        $p->content = 'dataid'.$this->dataId;*/


        if ($this->dataId !== null) {
            $this->loadUpdateForm();
        }

        return parent::getContent();

    }

}