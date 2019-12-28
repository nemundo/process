<?php
namespace Nemundo\Process\App\Plz\Data\Plz;
class PlzExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $plz;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $ort;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = PlzModel::class;
$this->externalTableName = "plz_plz";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->plz = new \Nemundo\Model\Type\Text\TextType();
$this->plz->fieldName = "plz";
$this->plz->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->plz->aliasFieldName = $this->plz->tableName . "_" . $this->plz->fieldName;
$this->plz->label = "Plz";
$this->addType($this->plz);

$this->ort = new \Nemundo\Model\Type\Text\TextType();
$this->ort->fieldName = "ort";
$this->ort->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->ort->aliasFieldName = $this->ort->tableName . "_" . $this->ort->fieldName;
$this->ort->label = "Ort";
$this->addType($this->ort);

}
}