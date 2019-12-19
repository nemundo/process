<?php
namespace Nemundo\Process\Template\Data\Youtube;
class YoutubeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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

protected function loadModel() {
$this->tableName = "template_youtube";
$this->aliasTableName = "template_youtube";
$this->label = "Youtube";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_youtube";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_youtube_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->url = new \Nemundo\Model\Type\Text\TextType($this);
$this->url->tableName = "template_youtube";
$this->url->fieldName = "url";
$this->url->aliasFieldName = "template_youtube_url";
$this->url->label = "Url";
$this->url->allowNullValue = false;
$this->url->length = 255;

$this->youtubeId = new \Nemundo\Model\Type\Text\TextType($this);
$this->youtubeId->tableName = "template_youtube";
$this->youtubeId->fieldName = "youtube_id";
$this->youtubeId->aliasFieldName = "template_youtube_youtube_id";
$this->youtubeId->label = "Youtube Id";
$this->youtubeId->allowNullValue = false;
$this->youtubeId->length = 255;

}
}