<?php
namespace Nemundo\Process\App\Video\Data\YouTube;
class YouTubeModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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

protected function loadModel() {
$this->tableName = "video_youtube";
$this->aliasTableName = "video_youtube";
$this->label = "YouTube";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "video_youtube";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "video_youtube_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->youtubeId = new \Nemundo\Model\Type\Text\TextType($this);
$this->youtubeId->tableName = "video_youtube";
$this->youtubeId->fieldName = "youtube_id";
$this->youtubeId->aliasFieldName = "video_youtube_youtube_id";
$this->youtubeId->label = "YouTube Id";
$this->youtubeId->allowNullValue = false;
$this->youtubeId->length = 255;

$this->title = new \Nemundo\Model\Type\Text\TextType($this);
$this->title->tableName = "video_youtube";
$this->title->fieldName = "title";
$this->title->aliasFieldName = "video_youtube_title";
$this->title->label = "Title";
$this->title->allowNullValue = false;
$this->title->length = 255;

$this->description = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->description->tableName = "video_youtube";
$this->description->fieldName = "description";
$this->description->aliasFieldName = "video_youtube_description";
$this->description->label = "Description";
$this->description->allowNullValue = false;

}
}