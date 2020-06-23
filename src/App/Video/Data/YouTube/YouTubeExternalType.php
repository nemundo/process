<?php
namespace Nemundo\Process\App\Video\Data\YouTube;
class YouTubeExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $youtubeId;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $title;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $description;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = YouTubeModel::class;
$this->externalTableName = "video_youtube";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->youtubeId = new \Nemundo\Model\Type\Text\TextType();
$this->youtubeId->fieldName = "youtube_id";
$this->youtubeId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->youtubeId->aliasFieldName = $this->youtubeId->tableName . "_" . $this->youtubeId->fieldName;
$this->youtubeId->label = "YouTube Id";
$this->addType($this->youtubeId);

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

}
}