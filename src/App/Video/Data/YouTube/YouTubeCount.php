<?php
namespace Nemundo\Process\App\Video\Data\YouTube;
class YouTubeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var YouTubeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new YouTubeModel();
}
}