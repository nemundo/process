<?php


namespace Nemundo\Process\Content\Form;


use Nemundo\Html\Paragraph\Paragraph;

class ContentForm extends AbstractContentForm
{

    public function getContent()
    {

        /*
        $p = new Paragraph($this);
        $p->content = 'Content Form';


        $p = new Paragraph($this);
        $p->content = 'Run Action: ' . $this->contentType->typeLabel;*/

        $this->submitButton->label =  $this->contentType->typeLabel;

        return parent::getContent();

    }


    protected function onSubmit()
    {

        $this->contentType->saveType();

    }

}