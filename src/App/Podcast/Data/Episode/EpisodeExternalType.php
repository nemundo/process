<?php
namespace Nemundo\Process\App\Podcast\Data\Episode;
class EpisodeExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $podcastId;

/**
* @var \Nemundo\Process\App\Podcast\Data\Feed\FeedExternalType
*/
public $podcast;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = EpisodeModel::class;
$this->externalTableName = "podcast_episode";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->podcastId = new \Nemundo\Model\Type\Id\IdType();
$this->podcastId->fieldName = "podcast";
$this->podcastId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->podcastId->aliasFieldName = $this->podcastId->tableName ."_".$this->podcastId->fieldName;
$this->podcastId->label = "Podcast";
$this->addType($this->podcastId);

}
public function loadPodcast() {
if ($this->podcast == null) {
$this->podcast = new \Nemundo\Process\App\Podcast\Data\Feed\FeedExternalType(null, $this->parentFieldName . "_podcast");
$this->podcast->fieldName = "podcast";
$this->podcast->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->podcast->aliasFieldName = $this->podcast->tableName ."_".$this->podcast->fieldName;
$this->podcast->label = "Podcast";
$this->addType($this->podcast);
}
return $this;
}
}