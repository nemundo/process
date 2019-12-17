<?php
namespace Nemundo\Process\App\News\Data\News;
class NewsBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var NewsModel
*/
protected $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $title;

/**
* @var string
*/
public $teaser;

public function __construct() {
parent::__construct();
$this->model = new NewsModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$this->typeValueList->setModelValue($this->model->teaser, $this->teaser);
$id = parent::save();
return $id;
}
}