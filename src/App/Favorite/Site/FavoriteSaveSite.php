<?php

namespace Nemundo\Process\App\Favorite\Site;

use Nemundo\Package\FontAwesome\Site\AbstractIconSite;
use Nemundo\Process\App\Favorite\Data\Favorite\Favorite;
use Nemundo\Process\App\Favorite\Icon\EmptyFavoriteIcon;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\User\Session\UserSession;
use Nemundo\Core\Http\Url\UrlReferer;

class FavoriteSaveSite extends AbstractIconSite
{

    /**
     * @var FavoriteSaveSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Favorite';
        $this->url = 'favorite-save';
        $this->menuActive = false;
        $this->icon = new EmptyFavoriteIcon();

        new FavoriteDeleteSite($this);

        FavoriteSaveSite::$site = $this;

    }


    public function loadContent()
    {

        $contentParameter = new ContentParameter();
        $contentParameter->contentTypeCheck = false;
        $contentType = $contentParameter->getContentType();

        $data = new Favorite();
        $data->contentId = (new ContentParameter())->getValue();
        $data->userId = (new UserSession())->userId;
        $data->subject = '[No Subject]';
        $data->save();

        $contentType->saveIndex();





        (new UrlReferer())->redirect();

    }

}