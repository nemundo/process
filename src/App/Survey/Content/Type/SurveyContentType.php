<?php


namespace Nemundo\Process\App\Survey\Content\Type;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\App\Survey\Content\Form\SurveyContentContainer;
use Nemundo\Process\App\Survey\Content\Form\SurveyErfassungContentForm;
use Nemundo\Process\App\Survey\Content\View\SurveyContentView;
use Nemundo\Process\Content\Type\AbstractMenuContentType;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;

class SurveyContentType extends AbstractSequenceContentType
{

    protected function loadContentType()
    {
        // TODO: Implement loadContentType() method.

        $this->typeId='b6757597-14a7-49a3-bf2c-8869917216a6';
        $this->typeLabel = 'Survey';
        //$this->formClass = SurveyContentContainer::class;
        $this->viewClass=SurveyContentView::class;


        $this->startContentType = new ErfassungContentType();  //  ErfassungContentType::class;




    }


    public function getForm(AbstractHtmlContainer $parent)
    {

        $form= $this->startContentType->getForm($parent);
        return $form;

    }


}