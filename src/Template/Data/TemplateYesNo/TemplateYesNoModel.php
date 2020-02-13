<?php
namespace Nemundo\Process\Template\Data\TemplateYesNo;
class TemplateYesNoModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Number\YesNoType
*/
public $yesNo;

protected function loadModel() {
$this->tableName = "template_template_yes_no";
$this->aliasTableName = "template_template_yes_no";
$this->label = "Template Yes No";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_template_yes_no";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_template_yes_no_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->yesNo = new \Nemundo\Model\Type\Number\YesNoType($this);
$this->yesNo->tableName = "template_template_yes_no";
$this->yesNo->fieldName = "yes_no";
$this->yesNo->aliasFieldName = "template_template_yes_no_yes_no";
$this->yesNo->label = "Yes No";
$this->yesNo->allowNullValue = false;

}
}