<?php
namespace Nemundo\Process\App\Feed\Data\FeedItem;
class FeedItemModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $feedId;

/**
* @var \Nemundo\Process\App\Feed\Data\Feed\FeedExternalType
*/
public $feed;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $title;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $description;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $url;

protected function loadModel() {
$this->tableName = "feed_item";
$this->aliasTableName = "feed_item";
$this->label = "Feed Item";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "feed_item";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "feed_item_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->feedId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->feedId->tableName = "feed_item";
$this->feedId->fieldName = "feed";
$this->feedId->aliasFieldName = "feed_item_feed";
$this->feedId->label = "Feed";
$this->feedId->allowNullValue = false;

$this->title = new \Nemundo\Model\Type\Text\TextType($this);
$this->title->tableName = "feed_item";
$this->title->fieldName = "title";
$this->title->aliasFieldName = "feed_item_title";
$this->title->label = "Title";
$this->title->allowNullValue = false;
$this->title->length = 255;

$this->description = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->description->tableName = "feed_item";
$this->description->fieldName = "description";
$this->description->aliasFieldName = "feed_item_description";
$this->description->label = "Description";
$this->description->allowNullValue = false;

$this->url = new \Nemundo\Model\Type\Text\TextType($this);
$this->url->tableName = "feed_item";
$this->url->fieldName = "url";
$this->url->aliasFieldName = "feed_item_url";
$this->url->label = "Url";
$this->url->allowNullValue = false;
$this->url->length = 255;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "url";
$index->addType($this->url);

}
public function loadFeed() {
if ($this->feed == null) {
$this->feed = new \Nemundo\Process\App\Feed\Data\Feed\FeedExternalType($this, "feed_item_feed");
$this->feed->tableName = "feed_item";
$this->feed->fieldName = "feed";
$this->feed->aliasFieldName = "feed_item_feed";
$this->feed->label = "Feed";
}
return $this;
}
}