<?php


namespace Nemundo\Process\Workflow\Content\Form;


class EmptyStatusForm extends AbstractStatusForm
{

    protected function onSubmit()
    {

        $this->contentType->saveType();

    }

}