<?php
namespace Nemundo\Process\App\Wiki\Data\Wiki;
class WikiBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var WikiModel
*/
protected $model;

/**
* @var string
*/
public $title;

public function __construct() {
parent::__construct();
$this->model = new WikiModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->title, $this->title);
$id = parent::save();
return $id;
}
}