<?php
namespace Nemundo\Process\Template\Data\Youtube;
class YoutubeDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var YoutubeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new YoutubeModel();
}
}