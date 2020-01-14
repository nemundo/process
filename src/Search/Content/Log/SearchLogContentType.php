<?php


namespace Nemundo\Process\Search\Content\Log;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Content\Type\AbstractType;
use Nemundo\Process\Search\Data\SearchLog\SearchLog;

class SearchLogContentType extends AbstractTreeContentType  // AbstractContentType  // AbstractType
{

    public $searchQuery;

    public $resultCount;


    protected function loadContentType()
    {
   $this->typeLabel='Search Log';
   $this->typeId='9e044ebe-b58d-470c-8d5c-476c8e1452d2';
        // TODO: Implement loadContentType() method.
    }


    protected function onCreate()
    {

        $data = new SearchLog();
        $data->searchQuery = $this->searchQuery;
        $data->resultCount = $this->resultCount;
        $this->dataId = $data->save();


    }

}