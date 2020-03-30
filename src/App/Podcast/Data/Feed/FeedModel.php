<?php
namespace Nemundo\Process\App\Podcast\Data\Feed;
class FeedModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $rssUrl;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $title;

protected function loadModel() {
$this->tableName = "podcast_feed";
$this->aliasTableName = "podcast_feed";
$this->label = "Feed";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "podcast_feed";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "podcast_feed_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->rssUrl = new \Nemundo\Model\Type\Text\TextType($this);
$this->rssUrl->tableName = "podcast_feed";
$this->rssUrl->fieldName = "rss_url";
$this->rssUrl->aliasFieldName = "podcast_feed_rss_url";
$this->rssUrl->label = "Rss Url";
$this->rssUrl->allowNullValue = false;
$this->rssUrl->length = 255;

$this->title = new \Nemundo\Model\Type\Text\TextType($this);
$this->title->tableName = "podcast_feed";
$this->title->fieldName = "title";
$this->title->aliasFieldName = "podcast_feed_title";
$this->title->label = "Title";
$this->title->allowNullValue = false;
$this->title->length = 255;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "rss_url";
$index->addType($this->rssUrl);

}
}