<?php


namespace Nemundo\Process\Content\Form;


use Nemundo\Admin\Com\Form\AbstractAdminForm;
use Nemundo\Core\Debug\Debug;
use Nemundo\Html\Paragraph\Paragraph;


// AbstractTreeContentForm
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

        if (!$this->createMode) {
            $this->loadUpdateForm();
        }

        return parent::getContent();

    }

}