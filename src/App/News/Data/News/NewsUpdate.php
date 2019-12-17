<?php
namespace Nemundo\Process\App\News\Data\News;
use Nemundo\Model\Data\AbstractModelUpdate;
class NewsUpdate extends AbstractModelUpdate {
/**
* @var NewsModel
*/
public $model;

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
public function update() {
$this->typeValueList->setModelValue($this->model->title, $this->title);
$this->typeValueList->setModelValue($this->model->teaser, $this->teaser);
parent::update();
}
}