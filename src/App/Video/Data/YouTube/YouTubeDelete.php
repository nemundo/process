<?php
namespace Nemundo\Process\App\Video\Data\YouTube;
class YouTubeDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var YouTubeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new YouTubeModel();
}
}