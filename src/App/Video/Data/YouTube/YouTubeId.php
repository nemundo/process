<?php
namespace Nemundo\Process\App\Video\Data\YouTube;
use Nemundo\Model\Id\AbstractModelIdValue;
class YouTubeId extends AbstractModelIdValue {
/**
* @var YouTubeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new YouTubeModel();
}
}