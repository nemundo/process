<?php
namespace Nemundo\Process\App\Podcast\Data\Podcast;
class PodcastExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $rssUrl;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = PodcastModel::class;
$this->externalTableName = "podcast_podcast";
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

}
}