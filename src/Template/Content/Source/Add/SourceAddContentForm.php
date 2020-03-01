<?php


namespace Nemundo\Process\Template\Content\Source\Add;


use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\App\Assignment\Parameter\SourceParameter;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexReader;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Schleuniger\App\Aufgabe\Content\Process\AufgabeProcess;
use Schleuniger\App\Verbesserung\Workflow\Process\VerbesserungProcess;


class SourceAddContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapListBox
     */
    private $content;

    public function getContent()
    {



        $sourceId = (new SourceParameter())->getValue();

        $sourceContentType = (new ContentTypeReader())->getRowById($sourceId)->getContentType();

        $this->content = new BootstrapListBox($this);
        $this->content->label=  $sourceContentType->typeLabel;  //'Content';  // 'Quelle';
        $this->content->validation=true;

        
        $taskReader = new TaskIndexReader();
        $taskReader->filter->andEqual($taskReader->model->taskTypeId,$sourceId);
        $taskReader->filter->andEqual($taskReader->model->closed,false);
        $taskReader->addOrder($taskReader->model->subject);
        foreach ($taskReader->getData() as $taskRow) {
            $this->content->addItem($taskRow->contentId, $taskRow->subject);
        }
        
        // für Content
        /*
        $treeReader = new ContentReader();
        $treeReader->filter->orEqual($treeReader->model->contentTypeId,$sourceId);
         $treeReader->addOrder($treeReader->model->subject);
         foreach ($treeReader->getData() as $contentRow) {
             $this->content->addItem($contentRow->id, $contentRow->subject);
         }*/

        return parent::getContent();

    }


    protected function onSubmit()
    {

        //$type = new SourceAddContentType();
        //$type->parentId = $this->parentId;
//        $this->contentType->childId = $this->content->getValue();
        $this->contentType->sourceId = $this->content->getValue();

        $this->contentType->saveType();

        // TODO: Implement onSubmit() method.
    }


}