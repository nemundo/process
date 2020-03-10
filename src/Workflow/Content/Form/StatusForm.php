<?php


namespace Nemundo\Process\Workflow\Content\Form;



use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Core\Language\Translation;
use Nemundo\Html\Paragraph\Paragraph;


// ProcessStatusForm
class StatusForm extends AbstractStatusForm
{


    public function getContent()
    {

        //$p = new Paragraph($this);
        //$p->content = 'Process Status: ' .(new Translation())->getText( $this->contentType->typeLabel);

        $subtitle=new AdminSubtitle($this);
        $subtitle->content= (new Translation())->getText( $this->contentType->typeLabel);

        return parent::getContent();
    }

    protected function onSubmit()
    {

        //$this->contentType->parentId = $this->parentId;
        $this->contentType->saveType();

    }

}