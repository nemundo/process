<?php
namespace Nemundo\Process\Template\Data\SourceLog;
class SourceLogModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $sourceId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $source;

protected function loadModel() {
$this->tableName = "process_template_source_log";
$this->aliasTableName = "process_template_source_log";
$this->label = "Source Log";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_source_log";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_source_log_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->sourceId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->sourceId->tableName = "process_template_source_log";
$this->sourceId->fieldName = "source";
$this->sourceId->aliasFieldName = "process_template_source_log_source";
$this->sourceId->label = "Source";
$this->sourceId->allowNullValue = false;

}
public function loadSource() {
if ($this->source == null) {
$this->source = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_template_source_log_source");
$this->source->tableName = "process_template_source_log";
$this->source->fieldName = "source";
$this->source->aliasFieldName = "process_template_source_log_source";
$this->source->label = "Source";
}
return $this;
}
}