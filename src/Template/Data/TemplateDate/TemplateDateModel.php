<?php
namespace Nemundo\Process\Template\Data\TemplateDate;
class TemplateDateModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\DateTime\DateType
*/
public $date;

protected function loadModel() {
$this->tableName = "process_template_date";
$this->aliasTableName = "process_template_date";
$this->label = "Template Date";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_template_date";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_template_date_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;

$this->date = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->date->tableName = "process_template_date";
$this->date->fieldName = "date";
$this->date->aliasFieldName = "process_template_date_date";
$this->date->label = "Date";
$this->date->allowNullValue = false;

}
}