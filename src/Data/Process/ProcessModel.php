<?php
namespace Nemundo\Process\Data\Process;
class ProcessModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $process;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $processClass;

protected function loadModel() {
$this->tableName = "process_process";
$this->aliasTableName = "process_process";
$this->label = "Process";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_process";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_process_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->process = new \Nemundo\Model\Type\Text\TextType($this);
$this->process->tableName = "process_process";
$this->process->fieldName = "process";
$this->process->aliasFieldName = "process_process_process";
$this->process->label = "Process";
$this->process->allowNullValue = false;
$this->process->length = 255;

$this->processClass = new \Nemundo\Model\Type\Text\TextType($this);
$this->processClass->tableName = "process_process";
$this->processClass->fieldName = "process_class";
$this->processClass->aliasFieldName = "process_process_process_class";
$this->processClass->label = "Process Class";
$this->processClass->allowNullValue = false;
$this->processClass->length = 255;

}
}