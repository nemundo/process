<?php
namespace Nemundo\Process\Template\Data\Youtube;
class YoutubeExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $url;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $youtubeId;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = YoutubeModel::class;
$this->externalTableName = "template_youtube";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->url = new \Nemundo\Model\Type\Text\TextType();
$this->url->fieldName = "url";
$this->url->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->url->aliasFieldName = $this->url->tableName . "_" . $this->url->fieldName;
$this->url->label = "Url";
$this->addType($this->url);

$this->youtubeId = new \Nemundo\Model\Type\Text\TextType();
$this->youtubeId->fieldName = "youtube_id";
$this->youtubeId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->youtubeId->aliasFieldName = $this->youtubeId->tableName . "_" . $this->youtubeId->fieldName;
$this->youtubeId->label = "Youtube Id";
$this->addType($this->youtubeId);

}
}