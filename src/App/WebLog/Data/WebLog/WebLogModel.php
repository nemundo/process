<?php
namespace Nemundo\Process\App\WebLog\Data\WebLog;
class WebLogModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

protected function loadModel() {
$this->tableName = "weblog_weblog";
$this->aliasTableName = "weblog_weblog";
$this->label = "WebLog";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "weblog_weblog";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "weblog_weblog_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

}
}