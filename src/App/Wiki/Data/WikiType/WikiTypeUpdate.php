<?php
namespace Nemundo\Process\App\Wiki\Data\WikiType;
use Nemundo\Model\Data\AbstractModelUpdate;
class WikiTypeUpdate extends AbstractModelUpdate {
/**
* @var WikiTypeModel
*/
public $model;

/**
* @var string
*/
public $contentTypeId;

public function __construct() {
parent::__construct();
$this->model = new WikiTypeModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
parent::update();
}
}