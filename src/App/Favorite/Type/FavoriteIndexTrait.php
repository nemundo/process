<?php


namespace Nemundo\Process\App\Favorite\Type;


use Nemundo\Process\App\Favorite\Data\Favorite\FavoriteUpdate;

trait FavoriteIndexTrait
{

    protected function saveFavoriteIndex()
    {

        $update = new FavoriteUpdate();
        $update->subject = $this->getSubject();
        $update->filter->andEqual($update->model->contentId, $this->getContentId());
        $update->update();

    }

}