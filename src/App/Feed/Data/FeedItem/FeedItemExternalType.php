<?php
namespace Nemundo\Process\App\Feed\Data\FeedItem;
class FeedItemExternalType extends \Nemundo\Model\Type\External\ExternalType {
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

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = FeedItemModel::class;
$this->externalTableName = "feed_item";
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

$this->title = new \Nemundo\Model\Type\Text\TextType();
$this->title->fieldName = "title";
$this->title->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->title->aliasFieldName = $this->title->tableName . "_" . $this->title->fieldName;
$this->title->label = "Title";
$this->addType($this->title);

$this->description = new \Nemundo\Model\Type\Text\LargeTextType();
$this->description->fieldName = "description";
$this->description->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->description->aliasFieldName = $this->description->tableName . "_" . $this->description->fieldName;
$this->description->label = "Description";
$this->addType($this->description);

$this->url = new \Nemundo\Model\Type\Text\TextType();
$this->url->fieldName = "url";
$this->url->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->url->aliasFieldName = $this->url->tableName . "_" . $this->url->fieldName;
$this->url->label = "Url";
$this->addType($this->url);

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