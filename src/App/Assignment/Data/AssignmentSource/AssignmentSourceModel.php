<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentSource;
class AssignmentSourceModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $sourceId;

/**
* @var \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType
*/
public $source;

protected function loadModel() {
$this->tableName = "assignment_assignment_source";
$this->aliasTableName = "assignment_assignment_source";
$this->label = "Assignment Source";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "assignment_assignment_source";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "assignment_assignment_source_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->sourceId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->sourceId->tableName = "assignment_assignment_source";
$this->sourceId->fieldName = "source";
$this->sourceId->aliasFieldName = "assignment_assignment_source_source";
$this->sourceId->label = "Source";
$this->sourceId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "source";
$index->addType($this->sourceId);

}
public function loadSource() {
if ($this->source == null) {
$this->source = new \Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType($this, "assignment_assignment_source_source");
$this->source->tableName = "assignment_assignment_source";
$this->source->fieldName = "source";
$this->source->aliasFieldName = "assignment_assignment_source_source";
$this->source->label = "Source";
}
return $this;
}
}