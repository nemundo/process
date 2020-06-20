<?php
namespace Nemundo\Process\App\Stream\Data\Stream;
class Stream extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var StreamModel
*/
protected $model;

/**
* @var string
*/
public $contentId;

public function __construct() {
parent::__construct();
$this->model = new StreamModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$id = parent::save();
return $id;
}
}