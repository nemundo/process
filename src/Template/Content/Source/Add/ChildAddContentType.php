<?php


namespace Nemundo\Process\Template\Content\Source\Add;


use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\App\Assignment\Data\AssignmentIndex\AssignmentIndex;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Content\Writer\TreeWriter;
use Nemundo\Process\Template\Content\Source\AbstractSourceContentType;
use Nemundo\Process\Template\Data\SourceLog\SourceLog;
use Nemundo\Process\Template\Data\SourceLog\SourceLogReader;

class ChildAddContentType extends AbstractSourceContentType
{

    public $sourceId;

    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Add Child';
        $this->typeLabel[LanguageCode::DE] = 'Add Child (Aufgabe hinzufügen)';

        $this->typeId = 'bba22817-9b78-40f8-b1fc-2d20372ac891';
        $this->formClass  =SourceAddContentContainer::class;  // AddSourceContentForm::class;

    }


    public function onCreate()
    {

        $data = new SourceLog();
        $data->sourceId = $this->sourceId;
        $this->dataId = $data->save();

        $writer = new TreeWriter();
        $writer->parentId =$this->parentId;// $this->sourceId;
        $writer->dataId =$this->sourceId; //$this->parentId;
        $writer->write();


        $contentReader  =new ContentReader();
           $contentReader->model->loadContentType();
        $contentType = $contentReader->getRowById($this->sourceId)->getContentType();

        //(new Debug())->write($contentType->getSubject());
        //exit;

        $contentType->saveIndex();



        //$parentContentType = $this->getParentContentType();

        $data = new AssignmentIndex();
        $data->sourceId =$this->getParentId();//  $this->sourceId;
        $data->contentId =  $this->sourceId;  // $this->getParentId();

        //$data->assignmentId = $this->groupId;
        //$data->deadline = $this->deadline;

        $data->save();




    }


    /*
    public function getDataRow()
    {

        $reader = new SourceLogReader();
        $reader->model->loadSource();
        $reader->model->source->loadContentType();
        return $reader->getRowById($this->dataId);
    }*/


    public function getSubject()
    {

        //  $site = $this->getDataRow()->source->getContentType()->getViewSite();

        //$hyerplink = new SiteHyperlink();
        //$hyerplink->site = $this->getDataRow()->source->getContentType()->getSubjectViewSite();


        $subject[LanguageCode::EN] = 'Source ' . $this->getHyperlinkContent() . ' was added';  //' $this->getDataRow()->source->getContentType()->getSubject();
        $subject[LanguageCode::DE] = 'Aufgabe (Child) ' . $this->getHyperlinkContent() . ' wurde hinzugefügt';

        return (new Translation())->getText($subject);

    }

}