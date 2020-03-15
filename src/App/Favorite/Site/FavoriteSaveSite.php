<?php

namespace Nemundo\Process\App\Favorite\Site;

use Nemundo\Process\App\Favorite\Content\FavoriteContentType;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;

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

        FavoriteSaveSite::$site = $this;
    }


    public function loadContent()
    {

        //$parameter=new ContentParameter();
        //$parameter->contentTypeCheck=false;
        //$contentType = $parameter->getContentType();


        $data = new Favorite();
        $data->contentId = (new ContentParameter())->getValue();
        $data->userId = (new UserSessionType())->userId;
        $data->save();



        /*
        $type=new FavoriteContentType();
        $type->parentId = $contentType->getContentId();
        $type->saveType();

        /*
        $data = new Favorite();
        $data->contentId = (new DataParameter())->getValue();

        //$data->dataId = (new DataIdParameter())->getValue();
        $data->userId = (new UserSessionType())->userId;
        $data->save();*/

        (new UrlReferer())->redirect();

    }

}