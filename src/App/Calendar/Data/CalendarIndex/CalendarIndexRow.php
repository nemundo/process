<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarIndex;
class CalendarIndexRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var CalendarIndexModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var int
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Row\ContentCustomRow
*/
public $content;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $date;

/**
* @var string
*/
public $title;

/**
* @var string
*/
public $place;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->contentId = intval($this->getModelValue($model->contentId));
if ($model->content !== null) {
$this->loadNemundoProcessContentDataContentContentcontentRow($model->content);
}
$value = $this->getModelValue($model->date);
if ($value !== "0000-00-00") {
$this->date = new \Nemundo\Core\Type\DateTime\Date($this->getModelValue($model->date));
}
$this->title = $this->getModelValue($model->title);
$this->place = $this->getModelValue($model->place);
}
private function loadNemundoProcessContentDataContentContentcontentRow($model) {
$this->content = new \Nemundo\Process\Content\Row\ContentCustomRow($this->row, $model);
}
}