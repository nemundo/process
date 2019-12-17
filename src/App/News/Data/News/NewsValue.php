<?php
namespace Nemundo\Process\App\News\Data\News;
class NewsValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var NewsModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new NewsModel();
}
}