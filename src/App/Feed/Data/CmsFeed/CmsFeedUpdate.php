<?php
namespace Nemundo\Process\App\Feed\Data\CmsFeed;
use Nemundo\Model\Data\AbstractModelUpdate;
class CmsFeedUpdate extends AbstractModelUpdate {
/**
* @var CmsFeedModel
*/
public $model;

/**
* @var string
*/
public $feedId;

public function __construct() {
parent::__construct();
$this->model = new CmsFeedModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->feedId, $this->feedId);
parent::update();
}
}