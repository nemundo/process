<?php


namespace Nemundo\Process\App\Wiki\Content;


use Nemundo\Process\App\Wiki\Data\Wiki\Wiki;
use Nemundo\Process\App\Wiki\Data\Wiki\WikiReader;
use Nemundo\Process\App\Wiki\Data\Wiki\WikiUpdate;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\App\Wiki\Site\WikiSite;
use Nemundo\Process\Content\Type\AbstractMenuContentType;

class WikiPageContentType extends AbstractMenuContentType
{

    public $title;


    protected function loadContentType()
    {

        $this->typeId = 'b94ec710-d1bd-4430-8866-4a7f9a493c52';
        $this->typeLabel = 'Wiki Page';
        $this->formClass = WikiPageContentForm::class;
        $this->listClass = WikiPageContentList::class;
        $this->viewSite = WikiSite::$site;
        $this->parameterClass = WikiParameter::class;

    }


    protected function onCreate()
    {

        $data = new Wiki();
        $data->title = $this->title;
        $this->dataId = $data->save();

    }


    protected function onUpdate()
    {

        $update = new WikiUpdate();
        $update->title = $this->title;
        $update->updateById($this->dataId);

    }


    protected function onSearchIndex()
    {

        $wikiRow = $this->getDataRow();
        $this->addSearchText($wikiRow->title);

    }


    public function getDataRow()
    {

        return (new WikiReader())->getRowById($this->dataId);

    }


    public function getSubject()
    {

        $wikiRow = $this->getDataRow();
        $subject = $wikiRow->title;

        return $subject;

    }

}