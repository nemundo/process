<?php
namespace Nemundo\Process\App\Feed\Data\Feed;
class FeedExternalType extends \Nemundo\Model\Type\External\ExternalType {
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

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = FeedModel::class;
$this->externalTableName = "feed_feed";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->feedUrl = new \Nemundo\Model\Type\Text\TextType();
$this->feedUrl->fieldName = "feed_url";
$this->feedUrl->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->feedUrl->aliasFieldName = $this->feedUrl->tableName . "_" . $this->feedUrl->fieldName;
$this->feedUrl->label = "Feed Url";
$this->addType($this->feedUrl);

$this->title = new \Nemundo\Model\Type\Text\TextType();
$this->title->fieldName = "title";
$this->title->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->title->aliasFieldName = $this->title->tableName . "_" . $this->title->fieldName;
$this->title->label = "Title";
$this->addType($this->title);

}
}