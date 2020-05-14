<?php
namespace Nemundo\Process\App\Feed\Data\Feed;
class FeedModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $feedUrl;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $title;

protected function loadModel() {
$this->tableName = "feed_feed";
$this->aliasTableName = "feed_feed";
$this->label = "Feed";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "feed_feed";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "feed_feed_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->feedUrl = new \Nemundo\Model\Type\Text\TextType($this);
$this->feedUrl->tableName = "feed_feed";
$this->feedUrl->fieldName = "feed_url";
$this->feedUrl->aliasFieldName = "feed_feed_feed_url";
$this->feedUrl->label = "Feed Url";
$this->feedUrl->allowNullValue = false;
$this->feedUrl->length = 255;

$this->title = new \Nemundo\Model\Type\Text\TextType($this);
$this->title->tableName = "feed_feed";
$this->title->fieldName = "title";
$this->title->aliasFieldName = "feed_feed_title";
$this->title->label = "Title";
$this->title->allowNullValue = false;
$this->title->length = 255;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "feed_url";
$index->addType($this->feedUrl);

}
}