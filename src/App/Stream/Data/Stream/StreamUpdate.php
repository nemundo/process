<?php
namespace Nemundo\Process\App\Stream\Data\Stream;
use Nemundo\Model\Data\AbstractModelUpdate;
class StreamUpdate extends AbstractModelUpdate {
/**
* @var StreamModel
*/
public $model;

/**
* @var string
*/
public $contentId;

public function __construct() {
parent::__construct();
$this->model = new StreamModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
parent::update();
}
}