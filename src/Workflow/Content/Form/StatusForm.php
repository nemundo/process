<?php


namespace Nemundo\Process\Workflow\Content\Form;



use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Core\Language\Translation;
use Nemundo\Html\Paragraph\Paragraph;


class StatusForm extends AbstractStatusForm
{

    public function getContent()
    {

        $subtitle=new AdminSubtitle($this);
        $subtitle->content= (new Translation())->getText( $this->contentType->typeLabel);

        return parent::getContent();
    }

    protected function onSubmit()
    {

        $this->contentType->saveType();

    }

}