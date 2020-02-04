<?php
namespace Nemundo\Process\App\Dashboard\Data\Dashboard;
use Nemundo\Model\Data\AbstractModelUpdate;
class DashboardUpdate extends AbstractModelUpdate {
/**
* @var DashboardModel
*/
public $model;

/**
* @var string
*/
public $contentId;

public function __construct() {
parent::__construct();
$this->model = new DashboardModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
parent::update();
}
}