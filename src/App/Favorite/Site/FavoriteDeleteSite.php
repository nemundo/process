<?php

namespace Nemundo\Process\App\Favorite\Site;

use Nemundo\Package\FontAwesome\Icon\DeleteIcon;
use Nemundo\Package\FontAwesome\Site\AbstractIconSite;
use Nemundo\Process\App\Favorite\Data\Favorite\FavoriteDelete;
use Nemundo\Process\App\Favorite\Icon\FavoriteIcon;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\User\Session\UserSession;
use Nemundo\Core\Http\Url\UrlReferer;

class FavoriteDeleteSite extends AbstractIconSite
{

    /**
     * @var FavoriteDeleteSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->icon = new DeleteIcon();
        $this->title = 'Favorit entfernen';
        $this->url = 'favorite-delete';
        $this->menuActive = false;
        $this->icon = new FavoriteIcon();

        FavoriteDeleteSite::$site = $this;

    }


    public function loadContent()
    {

        $delete = new FavoriteDelete();
        $delete->filter->andEqual($delete->model->contentId, (new ContentParameter())->getValue());
        $delete->filter->andEqual($delete->model->userId, (new UserSession())->userId);
        $delete->delete();

        (new UrlReferer())->redirect();

    }

}