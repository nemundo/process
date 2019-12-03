<?php
namespace Nemundo\Process\Data\Process;
class ProcessExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $process;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = ProcessModel::class;
$this->externalTableName = "process_process";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->process = new \Nemundo\Model\Type\Text\TextType();
$this->process->fieldName = "process";
$this->process->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->process->aliasFieldName = $this->process->tableName . "_" . $this->process->fieldName;
$this->process->label = "Process";
$this->addType($this->process);

}
}