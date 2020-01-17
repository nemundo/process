<?php


namespace Nemundo\Process\Template\Content\AddSource;


use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Content\Writer\TreeWriter;
use Nemundo\Process\Template\Data\SourceLog\SourceLog;
use Nemundo\Process\Template\Data\SourceLog\SourceLogReader;

class AddSourceContentType extends AbstractTreeContentType
{

    public $parentId;

    public $sourceId;

    protected function loadContentType()
    {

        $this->typeLabel = 'Add/Remove Source';
        $this->typeId = 'e40e4360-d630-42e2-a9f9-98a28ea6156d';
        $this->formClass = AddSourceContentForm::class;

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

    }


    public function getDataRow()
    {

        $reader = new SourceLogReader();
        $reader->model->loadSource();
        $reader->model->source->loadContentType();
        return $reader->getRowById($this->dataId);
    }


    public function getSubject()
    {

        //  $site = $this->getDataRow()->source->getContentType()->getViewSite();

        $hyerplink = new SiteHyperlink();
        $hyerplink->site = $this->getDataRow()->source->getContentType()->getViewSite();


        $subject = 'Source ' . $hyerplink->getContent() . ' was added';  //' $this->getDataRow()->source->getContentType()->getSubject();
        return $subject;

    }

}