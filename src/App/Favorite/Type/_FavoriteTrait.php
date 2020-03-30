<?php


namespace Nemundo\Process\App\Favorite\Type;


use Nemundo\Process\App\Favorite\Data\Favorite\FavoriteReader;

trait FavoriteTrait
{


    public function sendFavoriteNotification() {

        $favoriteReader = new FavoriteReader();
        $favoriteReader->filter->andEqual($favoriteReader->model->contentId, $this->getContentId());
        foreach ($favoriteReader->getData() as $favoriteRow) {
            $this->sendUserNotification($favoriteRow->userId);
        }

    }


}