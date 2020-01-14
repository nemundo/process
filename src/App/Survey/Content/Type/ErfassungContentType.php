<?php


namespace Nemundo\Process\App\Survey\Content\Type;


use Nemundo\Process\App\Survey\Content\Form\SurveyErfassungContentForm;
use Nemundo\Process\App\Survey\Data\Survey\Survey;
use Nemundo\Process\Content\Data\ContentStatus\ContentStatus;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractMenuContentType;
use Nemundo\Process\Template\Type\LargeTextContentType;
use Schleuniger\Content\Abschluss\AbschlussWorkflowStatus;

class ErfassungContentType extends AbstractMenuContentType
{

    public $firstName;


    protected function loadContentType()
    {
     $this->typeId='77390376-d9d2-4538-ac6b-297629531f5c';
     $this->typeLabel='Erfassung';
     $this->formClass=SurveyErfassungContentForm::class;
        // TODO: Implement loadContentType() method.

//$this->men nextCMenuClass= OptionTextContentType::class;

        $this->addMenuClass(AbschlussWorkflowStatus::class);
        $this->addMenuClass(LargeTextContentType::class);

    }


    protected function onCreate()
    {


        $type=new SurveyContentType();
       $this->parentId= $type->saveType();

        $data= new Survey();
        //$data->updateOnDuplicate=true;
        $data->id=$this->parentId;  //   $dataId;
        $data->vorname = $this->firstName;
        $data->save();


        $type->changeStatus($this);

        /*
        $data=new ContentStatus();
        $data->updateOnDuplicate=true;
        $data->contentId=$this->parentId;
        $data->statusId=$this->contentId;
        $data->save();*/


    }


}