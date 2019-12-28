<?php
namespace Nemundo\Process\Template\Data\Event;
class EventExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\DateTime\DateType
*/
public $date;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $event;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = EventModel::class;
$this->externalTableName = "template_event";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->date = new \Nemundo\Model\Type\DateTime\DateType();
$this->date->fieldName = "date";
$this->date->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->date->aliasFieldName = $this->date->tableName . "_" . $this->date->fieldName;
$this->date->label = "Date";
$this->addType($this->date);

$this->event = new \Nemundo\Model\Type\Text\TextType();
$this->event->fieldName = "event";
$this->event->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->event->aliasFieldName = $this->event->tableName . "_" . $this->event->fieldName;
$this->event->label = "Event";
$this->addType($this->event);

}
}