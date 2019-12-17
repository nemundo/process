<?php
namespace Nemundo\Process\App\News\Data\News;
class NewsDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var NewsModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new NewsModel();
}
}