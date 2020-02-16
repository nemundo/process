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
$this->tableName = "template_template_date";
$this->aliasTableName = "template_template_date";
$this->label = "Template Date";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_template_date";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_template_date_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->date = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->date->tableName = "template_template_date";
$this->date->fieldName = "date";
$this->date->aliasFieldName = "template_template_date_date";
$this->date->label = "Date";
$this->date->allowNullValue = false;

}
}