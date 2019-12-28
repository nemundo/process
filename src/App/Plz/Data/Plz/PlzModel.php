<?php
namespace Nemundo\Process\App\Plz\Data\Plz;
class PlzModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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

protected function loadModel() {
$this->tableName = "plz_plz";
$this->aliasTableName = "plz_plz";
$this->label = "Plz";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "plz_plz";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "plz_plz_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->plz = new \Nemundo\Model\Type\Text\TextType($this);
$this->plz->tableName = "plz_plz";
$this->plz->fieldName = "plz";
$this->plz->aliasFieldName = "plz_plz_plz";
$this->plz->label = "Plz";
$this->plz->allowNullValue = false;
$this->plz->length = 255;

$this->ort = new \Nemundo\Model\Type\Text\TextType($this);
$this->ort->tableName = "plz_plz";
$this->ort->fieldName = "ort";
$this->ort->aliasFieldName = "plz_plz_ort";
$this->ort->label = "Ort";
$this->ort->allowNullValue = false;
$this->ort->length = 255;

}
}