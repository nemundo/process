<?php
namespace Nemundo\Process\Template\Data\Event;
class EventModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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

protected function loadModel() {
$this->tableName = "template_event";
$this->aliasTableName = "template_event";
$this->label = "Event";

$this->primaryIndex = new \Nemundo\Db\Index\UniqueIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_event";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_event_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->date = new \Nemundo\Model\Type\DateTime\DateType($this);
$this->date->tableName = "template_event";
$this->date->fieldName = "date";
$this->date->aliasFieldName = "template_event_date";
$this->date->label = "Date";
$this->date->allowNullValue = false;

$this->event = new \Nemundo\Model\Type\Text\TextType($this);
$this->event->tableName = "template_event";
$this->event->fieldName = "event";
$this->event->aliasFieldName = "template_event_event";
$this->event->label = "Event";
$this->event->allowNullValue = false;
$this->event->length = 255;

}
}