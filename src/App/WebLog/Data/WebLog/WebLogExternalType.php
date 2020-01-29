<?php
namespace Nemundo\Process\App\WebLog\Data\WebLog;
class WebLogExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = WebLogModel::class;
$this->externalTableName = "weblog_weblog";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

}
}