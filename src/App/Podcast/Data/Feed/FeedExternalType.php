<?php
namespace Nemundo\Process\App\Podcast\Data\Feed;
class FeedExternalType extends \Nemundo\Model\Type\External\ExternalType {
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

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = FeedModel::class;
$this->externalTableName = "podcast_feed";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->rssUrl = new \Nemundo\Model\Type\Text\TextType();
$this->rssUrl->fieldName = "rss_url";
$this->rssUrl->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->rssUrl->aliasFieldName = $this->rssUrl->tableName . "_" . $this->rssUrl->fieldName;
$this->rssUrl->label = "Rss Url";
$this->addType($this->rssUrl);

$this->title = new \Nemundo\Model\Type\Text\TextType();
$this->title->fieldName = "title";
$this->title->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->title->aliasFieldName = $this->title->tableName . "_" . $this->title->fieldName;
$this->title->label = "Title";
$this->addType($this->title);

}
}