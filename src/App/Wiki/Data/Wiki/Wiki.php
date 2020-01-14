<?php
namespace Nemundo\Process\App\Wiki\Data\Wiki;
class Wiki extends \Nemundo\Model\Data\AbstractModelData {
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