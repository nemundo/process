<?php

namespace Nemundo\Process\App\Favorite\Site;

use Nemundo\Package\FontAwesome\Icon\DeleteIcon;
use Nemundo\Package\FontAwesome\Site\AbstractIconSite;
use Nemundo\Process\Content\Parameter\DataParameter;
use Nemundo\User\Type\UserSessionType;
use Nemundo\Web\Url\UrlReferer;
use Nemundo\Process\App\Favorite\Data\Favorite\FavoriteDelete;
use Nemundo\Process\App\Favorite\Parameter\FavoriteParameter;

class FavoriteDeleteSite extends AbstractIconSite
{

    /**
     * @var FavoriteDeleteSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->icon = new DeleteIcon();
        $this->url = 'favorite-delete';
        $this->menuActive = false;
        FavoriteDeleteSite::$site=$this;
    }


    protected function registerSite()
    {
        FavoriteDeleteSite::$site = $this;
    }


    public function loadContent()
    {


        //(new FavoriteDelete())->deleteById((new FavoriteParameter())->getValue());

        $delete = new FavoriteDelete();
        //$delete->filter->andEqual($delete->model->contentTypeId, (new ContentTypeParameter())->getValue());
        $delete->filter->andEqual($delete->model->contentId, (new DataParameter())->getValue());
        $delete->filter->andEqual($delete->model->userId, (new UserSessionType())->userId);
        $delete->delete();


        (new UrlReferer())->redirect();

    }

}