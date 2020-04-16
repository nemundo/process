<?php
namespace Nemundo\Process\Template\Data\TemplateDateLog;
class TemplateDateLogModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\DateTime\DateType
*/
public $dateFrom;

/**
* @var \Nemundo\Model\Type\DateTime\DateType
*/
public $dateTo;

protected function loadModel() {
$this->tableName = "process_template_date_log";
$this->aliasTableName = "process_template_date_log";
$this->label = "Template Date Log";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_date_log";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_date_log_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->dateFrom = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->dateFrom->tableName = "process_template_date_log";
$this->dateFrom->fieldName = "date_from";
$this->dateFrom->aliasFieldName = "process_template_date_log_date_from";
$this->dateFrom->label = "Date From";
$this->dateFrom->allowNullValue = false;

$this->dateTo = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->dateTo->tableName = "process_template_date_log";
$this->dateTo->fieldName = "date_to";
$this->dateTo->aliasFieldName = "process_template_date_log_date_to";
$this->dateTo->label = "Date To";
$this->dateTo->allowNullValue = false;

}
}