<?php


namespace Nemundo\Process\Search\Content\Log;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Search\Data\SearchLog\SearchLog;
use Nemundo\Process\Search\Data\SearchLog\SearchLogReader;
use Nemundo\Process\Search\Parameter\SearchQueryParameter;
use Nemundo\Process\Search\Site\SearchSite;

class SearchLogContentType extends AbstractTreeContentType  // AbstractContentType  // AbstractType
{

    public $searchQuery;

    public $resultCount;


    protected function loadContentType()
    {
        $this->typeLabel = 'Search Log';
        $this->typeId = '9e044ebe-b58d-470c-8d5c-476c8e1452d2';

        // redirect site
        // oder getviewSite
        //$this->viewSite=SearchSite::$site;



        // TODO: Implement loadContentType() method.
    }


    protected function onCreate()
    {

        $data = new SearchLog();
        $data->searchQuery = $this->searchQuery;
        $data->resultCount = $this->resultCount;
        $this->dataId = $data->save();

    }


    public function getDataRow()
    {
        return (new SearchLogReader())->getRowById($this->dataId);
    }

    public function getSubject()
    {

        //$logRow = (new SearchLogReader())->getRowById($this->dataId);
        $logRow = $this->getDataRow();
        $subject= 'Gesucht nach '.$logRow->searchQuery;
        return $subject;

    }


    public function hasViewSite()
    {
        return true;
    }

    public function getViewSite()
    {
        
        $logRow = $this->getDataRow();

        $site = clone(SearchSite::$site);
        $site->addParameter(new SearchQueryParameter($logRow->searchQuery));

        return $site;

    }


}