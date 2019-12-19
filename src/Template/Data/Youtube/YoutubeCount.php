<?php
namespace Nemundo\Process\Template\Data\Youtube;
class YoutubeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var YoutubeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new YoutubeModel();
}
}