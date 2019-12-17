<?php
namespace Nemundo\Process\App\News\Data\News;
use Nemundo\Model\Id\AbstractModelIdValue;
class NewsId extends AbstractModelIdValue {
/**
* @var NewsModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new NewsModel();
}
}