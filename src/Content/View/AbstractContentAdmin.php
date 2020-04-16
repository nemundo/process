<?php


namespace Nemundo\Process\Content\View;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Content\Com\Table\ContentLogTable;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Web\Action\AbstractActionPanel;
use Nemundo\Web\Action\ActionSite;
use Nemundo\Web\Action\Site\ActiveActionSite;
use Nemundo\Web\Action\Site\DeleteActionSite;
use Nemundo\Web\Action\Site\EditActionSite;
use Nemundo\Web\Url\UrlReferer;

abstract class AbstractContentAdmin extends AbstractActionPanel
{

    /**
     * @var AbstractTreeContentType
     */
    public $contentType;

    /**
     * @var ActionSite
     */
    protected $index;

    /**
     * @var ActionSite
     */
    protected $new;

    /**
     * @var ActionSite
     */
    protected $edit;

    /**
     * @var ActionSite
     */
    protected $delete;

    /**
     * @var ActionSite
     */
    protected $active;

    /**
     * @var ActionSite
     */
    protected $inactive;

    /**
     * @var ActionSite
     */
    protected $view;

    /**
     * @var AdminSiteButton
     */
    protected $newButton;

    /**
     * @var bool
     */
    protected $showTitle = true;

    protected function loadActionSite()
    {

        if ($this->showTitle) {
            $subtitle = new AdminSubtitle($this);
            $subtitle->content = $this->contentType->typeLabel;
        }

        $this->index = new ActionSite($this);
        $this->index->onAction = function () {

            if ($this->contentType->hasForm()) {
                $this->newButton = new AdminSiteButton($this);
                $this->newButton->site = $this->new;
            }

            $this->loadIndex();

        };


        $this->new = new ActionSite($this);
        $this->new->title[LanguageCode::EN] = 'New';
        $this->new->title[LanguageCode::DE] = 'Neu';
        $this->new->actionName = 'new';
        $this->new->onAction = function () {

            $this->loadNew();

        };

        $this->edit = new EditActionSite($this);
        $this->edit->title[LanguageCode::EN] = 'Edit';
        $this->edit->title[LanguageCode::DE] = 'Bearbeiten';
        $this->edit->actionName = 'edit';
        $this->edit->onAction = function () {

            $dataId = (new DataIdParameter())->getValue();
            $this->loadEdit($dataId);

        };

        $this->delete = new DeleteActionSite($this);
        $this->delete->title[LanguageCode::EN] = 'Delete';
        $this->delete->title[LanguageCode::DE] = 'Löschen';
        $this->delete->actionName = 'delete';
        $this->delete->onAction = function () {

            $dataId = (new DataIdParameter())->getValue();
            $this->loadDelete($dataId);
            (new UrlReferer())->redirect();

        };


        $this->active = new ActiveActionSite($this);
        $this->active->title[LanguageCode::EN] = 'Active';
        $this->active->title[LanguageCode::DE] = 'Aktivieren';
        $this->active->actionName = 'active';
        $this->active->onAction = function () {

            $dataId = (new DataIdParameter())->getValue();
            $this->loadActive($dataId);
            (new UrlReferer())->redirect();

        };


        $this->inactive = new DeleteActionSite($this);
        $this->inactive->title[LanguageCode::EN] = 'Inactive';
        $this->inactive->title[LanguageCode::DE] = 'Inaktiv setzen';
        $this->inactive->actionName = 'inactive';
        $this->inactive->onAction = function () {

            $dataId = (new DataIdParameter())->getValue();
            $this->loadInactive($dataId);
            (new UrlReferer())->redirect();

        };

        $this->view = new ActionSite($this);
        $this->view->title[LanguageCode::EN] = 'View';
        $this->view->title[LanguageCode::DE] = 'Detail';
        $this->view->actionName = 'view';
        $this->view->onAction = function () {

            $btn = new AdminSiteButton($this);
            $btn->content = 'Zurück';
            $btn->site = $this->index;

            $dataId = (new DataIdParameter())->getValue();
            $this->loadView($dataId);

        };

    }


    protected function loadIndex()
    {

    }


    protected function loadNew()
    {

        $form = $this->contentType->getForm($this);
        $form->redirectSite = $this->index;

    }


    protected function loadEdit($dataId)
    {

        $contentType = clone($this->contentType);
        $contentType->fromDataId($dataId);
        $form = $contentType->getForm($this);
        $form->redirectSite = $this->index;


    }


    protected function loadView($dataId)
    {

        $contentType = clone($this->contentType);
        $contentType->fromDataId($dataId);

        if ($contentType->hasView()) {
            $contentType->getView($this);
        }

        $p = new Paragraph($this);
        $p->content = $contentType->getSubject();

        $p = new Paragraph($this);
        $p->content = $contentType->getContentId();

        $contentReader = new ContentReader();
        $contentReader->model->loadUser();
        $contentRow = $contentReader->getRowById($contentType->getContentId());

        $table = new AdminLabelValueTable($this);
        $table->addLabelValue($contentReader->model->user->label, $contentRow->user->displayName);
        $table->addLabelValue($contentReader->model->dateTime->label, $contentRow->dateTime->getShortDateTimeLeadingZeroFormat());

        $log = new ContentLogTable($this);
        $log->contentType = $contentType;

    }


    protected function loadActive($dataId)
    {
        $this->contentType->fromDataId($dataId)->setActive();
    }


    protected function loadInactive($dataId)
    {

        $this->contentType->fromDataId($dataId)->setInactive();

    }


    protected function loadDelete($dataId)
    {
        $this->contentType->fromDataId($dataId)->deleteType();
    }


    protected function getEditSite($dataId)
    {

        $site = clone($this->edit);
        $site->addParameter(new DataIdParameter($dataId));
        return $site;

    }


    protected function getViewSite($dataId)
    {

        $site = clone($this->view);
        $site->addParameter(new DataIdParameter($dataId));
        return $site;

    }


    protected function getDeleteSite($dataId)
    {

        $site = clone($this->delete);
        $site->addParameter(new DataIdParameter($dataId));
        return $site;

    }


    protected function getActiveSite($dataId)
    {

        $site = clone($this->active);
        $site->addParameter(new DataIdParameter($dataId));
        return $site;

    }


    protected function getInactiveSite($dataId)
    {

        $site = clone($this->inactive);
        $site->addParameter(new DataIdParameter($dataId));
        return $site;

    }

}