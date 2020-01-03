<?php


namespace Nemundo\Process\App\Wiki\Content;


use Nemundo\Process\App\Wiki\Data\Wiki\Wiki;
use Nemundo\Process\App\Wiki\Data\Wiki\WikiReader;
use Nemundo\Process\Content\Data\ContentGroup\ContentGroup;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Content\Type\ContentTreeTrait;
use Nemundo\Process\Group\Content\Add\AddGroupContentItem;
use Nemundo\Process\Group\Type\PublicGroup;
use Nemundo\Process\Search\Index\SearchIndexBuilder;

class WikiPageContentItem extends AbstractContentItem
{

    use ContentTreeTrait;

    public $title;


    protected function saveData()
    {

        $this->contentType = new WikiPageContentType();

        $data = new Wiki();
        $data->id = $this->dataId;
        $data->title = $this->title;
        $data->save();

        $this->addSearchText($this->title);

        /*$this->saveContent();

        $search = new SearchIndexBuilder($this->dataId);
        $search->addText($this->title);
        $search->saveIndex();*/



        /*
        $item=new AddGroupContentItem();
        $item->parentId=$this->dataId;
        $item->groupId=(new PublicGroup())->id;
        $item->saveItem();
        */

    }


    /*
    public function getSubject()
    {
        $wikiRow = (new WikiReader())->getRowById($this->dataId);
        $subject = 'Wiki: '. $wikiRow->title;

        return $subject;
    }*/

}