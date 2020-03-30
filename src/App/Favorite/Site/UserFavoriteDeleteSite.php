<?php

namespace Nemundo\Process\App\Favorite\Site;

use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\App\Favorite\Data\Favorite\FavoriteDelete;
use Nemundo\Process\App\Favorite\Parameter\FavoriteParameter;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\User\Type\UserSessionType;
use Nemundo\Web\Url\UrlReferer;

class UserFavoriteDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var UserFavoriteDeleteSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Favorit löschen';
        $this->url = 'user-favorite-delete';

        UserFavoriteDeleteSite::$site = $this;

    }


    public function loadContent()
    {

        $favoriteId=(new FavoriteParameter())->getValue();
        (new FavoriteDelete())->deleteById($favoriteId);

        (new UrlReferer())->redirect();

    }

}