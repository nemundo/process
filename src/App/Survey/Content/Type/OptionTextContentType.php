<?php


namespace Nemundo\Process\App\Survey\Content\Type;


use Nemundo\Process\App\Survey\Content\Form\OptionTextContentForm;
use Nemundo\Process\Content\Type\AbstractMenuContentType;

class OptionTextContentType extends AbstractMenuContentType
{
    protected function loadContentType()
    {
        $this->contentLabel='Text Optionen';
     $this->contentId='89aa7b94-9291-4a86-894e-e5af2663c960';
     $this->formClass=OptionTextContentForm::class;

     $this->nextMenuClass=DescriptionContentType::class;
        // TODO: Implement loadContentType() method.
        $this->previousMenuClass=ErfassungContentType::class;
    }

}