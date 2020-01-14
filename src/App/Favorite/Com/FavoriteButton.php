<?php

namespace Nemundo\Process\App\Favorite\Com;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataParameter;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\App\Favorite\Data\Favorite\FavoriteCount;
use Nemundo\Process\App\Favorite\Site\FavoriteDeleteSite;
use Nemundo\Process\App\Favorite\Site\FavoriteSaveSite;
use Nemundo\User\Type\UserSessionType;


class FavoriteButton extends AbstractHtmlContainer
{

    /**
     * @var AbstractContentType
     */
    ///public $contentType;

    /**
     * @var string
     */
    public $dataId;  // = '0';

    /**
     * @var string
     */
    public $label = 'Favorite (Icon)/Bookmark';

    public function getContent()
    {

        $count = new FavoriteCount();
        //$count->filter->andEqual($count->model->contentTypeId, $this->contentType->contentId);
        $count->filter->andEqual($count->model->contentId, $this->dataId);
        $count->filter->andEqual($count->model->userId, (new UserSessionType())->userId);


        if ($count->getCount() == 0) {
            $button = new AdminSiteButton($this);
            $button->content = $this->label;
            $button->site = FavoriteSaveSite::$site;
            $button->site->addParameter(new DataParameter($this->dataId));
            //$button->site->addParameter(new ContentTypeParameter($this->contentType->id));

        } else {
            $p = new Paragraph($this);
            $p->content = 'Dein Favorit';

            $button = new AdminSiteButton($this);
            $button->content = 'Favorit löschen';
            $button->site = FavoriteDeleteSite::$site;
            //$button->site->addParameter(new SubscriptionParameter())
            $button->site->addParameter(new DataParameter($this->dataId));
            //$button->site->addParameter(new ContentTypeParameter($this->contentType->id));

        }

        return parent::getContent();

    }

}