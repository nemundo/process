<?php
namespace Nemundo\Process\App\Feed\Data\CmsFeed;
class CmsFeedExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $feedId;

/**
* @var \Nemundo\Process\App\Feed\Data\Feed\FeedExternalType
*/
public $feed;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = CmsFeedModel::class;
$this->externalTableName = "feed_cms_feed";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->feedId = new \Nemundo\Model\Type\Id\IdType();
$this->feedId->fieldName = "feed";
$this->feedId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->feedId->aliasFieldName = $this->feedId->tableName ."_".$this->feedId->fieldName;
$this->feedId->label = "Feed";
$this->addType($this->feedId);

}
public function loadFeed() {
if ($this->feed == null) {
$this->feed = new \Nemundo\Process\App\Feed\Data\Feed\FeedExternalType(null, $this->parentFieldName . "_feed");
$this->feed->fieldName = "feed";
$this->feed->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->feed->aliasFieldName = $this->feed->tableName ."_".$this->feed->fieldName;
$this->feed->label = "Feed";
$this->addType($this->feed);
}
return $this;
}
}