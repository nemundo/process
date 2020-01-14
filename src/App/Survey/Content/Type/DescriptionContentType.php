<?php


namespace Nemundo\Process\App\Survey\Content\Type;


use Nemundo\Process\App\Survey\Content\Form\DescriptionContentForm;
use Nemundo\Process\Content\Type\AbstractMenuContentType;

class DescriptionContentType extends AbstractMenuContentType
{

    protected function loadContentType()
    {
        $this->typeLabel='Description';
    $this->typeId='b977c350-a3a8-4279-b1c2-6d234fc749f7';
    $this->formClass=DescriptionContentForm::class;
        // TODO: Implement loadContentType() method.

        $this->previousMenuClass=OptionTextContentType::class;
    }

}