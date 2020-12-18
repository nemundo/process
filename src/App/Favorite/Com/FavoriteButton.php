<?php

namespace Nemundo\Process\App\Favorite\Com;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\App\Favorite\Data\Favorite\FavoriteCount;
use Nemundo\Process\App\Favorite\Site\FavoriteDeleteSite;
use Nemundo\Process\App\Favorite\Site\FavoriteSaveSite;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\User\Session\UserSession;


class FavoriteButton extends AbstractHtmlContainer
{

    /**
     * @var AbstractContentType
     */
    public $contentType;

    public function getContent()
    {


        $contentId = $this->contentType->getContentId();
        $contentParameter = new ContentParameter($contentId);

        $favoriteCount = new FavoriteCount();
        $favoriteCount->filter->andEqual($favoriteCount->model->contentId, $contentId);
        $favoriteCount->filter->andEqual($favoriteCount->model->userId, (new UserSession())->userId);

//        $button=null;
        $button = new AdminIconSiteButton($this);


        if ($favoriteCount->getCount() == 0) {
  //          $button = new AdminIconSiteButton($this);
            $button->site = FavoriteSaveSite::$site;
            $button->site->addParameter($contentParameter);

        } else {

    //        $button = new AdminIconSiteButton($this);
            $button->site = FavoriteDeleteSite::$site;
            $button->site->addParameter($contentParameter);

        }

        $button->showTitle=false;
        $button->title = $this->contentType->getSubject();


        return parent::getContent();

    }

}