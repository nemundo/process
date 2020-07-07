<?php
namespace Nemundo\Process\App\Feed\Data\CmsFeed;
class CmsFeedModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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

protected function loadModel() {
$this->tableName = "feed_cms_feed";
$this->aliasTableName = "feed_cms_feed";
$this->label = "Cms Feed";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "feed_cms_feed";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "feed_cms_feed_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->feedId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->feedId->tableName = "feed_cms_feed";
$this->feedId->fieldName = "feed";
$this->feedId->aliasFieldName = "feed_cms_feed_feed";
$this->feedId->label = "Feed";
$this->feedId->allowNullValue = false;

}
public function loadFeed() {
if ($this->feed == null) {
$this->feed = new \Nemundo\Process\App\Feed\Data\Feed\FeedExternalType($this, "feed_cms_feed_feed");
$this->feed->tableName = "feed_cms_feed";
$this->feed->fieldName = "feed";
$this->feed->aliasFieldName = "feed_cms_feed_feed";
$this->feed->label = "Feed";
}
return $this;
}
}