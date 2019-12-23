<?php

namespace Nemundo\Process\App\Favorite\Site;

use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\User\Type\UserSessionType;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Url\UrlReferer;
use Nemundo\Process\App\Favorite\Data\Favorite\Favorite;

class FavoriteSaveSite extends AbstractSite
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

        new FavoriteDeleteSite($this);
    }


    protected function registerSite()
    {
        FavoriteSaveSite::$site = $this;
    }


    public function loadContent()
    {

        $data = new Favorite();
        $data->contentId = (new DataIdParameter())->getValue();

        //$data->dataId = (new DataIdParameter())->getValue();
        $data->userId = (new UserSessionType())->userId;
        $data->save();

        (new UrlReferer())->redirect();

    }

}