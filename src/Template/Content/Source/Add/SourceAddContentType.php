<?php


namespace Nemundo\Process\Template\Content\Source\Add;


use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\App\Assignment\Data\AssignmentIndex\AssignmentIndex;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Content\Writer\TreeWriter;
use Nemundo\Process\Template\Content\Source\AbstractSourceContentType;
use Nemundo\Process\Template\Data\SourceLog\SourceLog;
use Nemundo\Process\Template\Data\SourceLog\SourceLogReader;

class SourceAddContentType extends AbstractSourceContentType  // AbstractTreeContentType
{

    public $sourceId;

    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Add Source';
        $this->typeLabel[LanguageCode::DE] = 'Quelle hinzufügen';

        $this->typeId = 'e40e4360-d630-42e2-a9f9-98a28ea6156d';
        $this->formClass  =SourceAddContentContainer::class;  // AddSourceContentForm::class;

    }


    public function onCreate()
    {

        $data = new SourceLog();
        $data->sourceId = $this->sourceId;
        $this->dataId = $data->save();

        $writer = new TreeWriter();
        $writer->parentId = $this->sourceId;
        $writer->dataId = $this->parentId;
        $writer->write();


        //$parentContentType = $this->getParentContentType();

        $data = new AssignmentIndex();
        $data->sourceId =  $this->sourceId;
        $data->contentId = $this->getParentId();

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


        $subject = 'Source ' . $this->getHyperlinkContent() . ' was added';  //' $this->getDataRow()->source->getContentType()->getSubject();
        return $subject;

    }

}