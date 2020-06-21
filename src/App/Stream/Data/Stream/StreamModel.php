<?php
namespace Nemundo\Process\App\Stream\Data\Stream;
class StreamModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

protected function loadModel() {
$this->tableName = "stream_stream";
$this->aliasTableName = "stream_stream";
$this->label = "Stream";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "stream_stream";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "stream_stream_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "stream_stream";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "stream_stream_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "content";
$index->addType($this->contentId);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "stream_stream_content");
$this->content->tableName = "stream_stream";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "stream_stream_content";
$this->content->label = "Content";
}
return $this;
}
}