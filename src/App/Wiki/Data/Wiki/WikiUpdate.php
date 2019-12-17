<?php
namespace Nemundo\Process\App\Wiki\Data\Wiki;
use Nemundo\Model\Data\AbstractModelUpdate;
class WikiUpdate extends AbstractModelUpdate {
/**
* @var WikiModel
*/
public $model;

/**
* @var string
*/
public $title;

public function __construct() {
parent::__construct();
$this->model = new WikiModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->title, $this->title);
parent::update();
}
}