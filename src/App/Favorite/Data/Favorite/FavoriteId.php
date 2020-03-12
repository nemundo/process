<?php
namespace Nemundo\Process\App\Favorite\Data\Favorite;
use Nemundo\Model\Id\AbstractModelIdValue;
class FavoriteId extends AbstractModelIdValue {
/**
* @var FavoriteModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FavoriteModel();
}
}