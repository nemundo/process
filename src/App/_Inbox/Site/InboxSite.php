<?php

namespace Nemundo\Process\App\Inbox\Site;

use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Block\Div;
use Nemundo\Html\Block\Hr;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Inbox\Data\Inbox\InboxReader;
use Nemundo\User\Com\ListBox\UserListBox;
use Nemundo\Web\Site\AbstractSite;

class InboxSite extends AbstractSite
{
    protected function loadSite()
    {
        $this->title = 'Inbox';
        $this->url = 'inbox';
    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $form = new SearchForm($page);

        $userListbox = new UserListBox($form);
        $userListbox->searchMode = true;
        $userListbox->submitOnChange = true;

        $layout = new BootstrapTwoColumnLayout($page);


        $stream = new Div($layout->col2);

        // inbox stream

        $table = new AdminClickableTable($layout->col1);

        $header = new TableHeader($table);
        $header->addText('Source/Absender');
        $header->addText('Subject');

        $header->addText('Message');
        $header->addText('Date/Time');

        $reader = new InboxReader();
        $reader->model->loadContentType();
        $reader->model->loadUser();
        $reader->filter->andEqual($reader->model->userId, $userListbox->getValue());
        $reader->addOrder($reader->model->id, SortOrder::DESCENDING);

        foreach ($reader->getData() as $inboxRow) {

            $contentType = $inboxRow->contentType->getContentType();

            $row = new BootstrapClickableTableRow($table);
            //$row->addText($contenType->getClassName());


            /*
            $contentReader = new ContentReader();
            $contentReader->filter->andEqual($contentReader->model->dataId, $inboxRow->dataId);
            $parentId = $contentReader->getRow()->parentId;

            $contentReader = new ContentReader();
            $contentReader->model->loadContentType();
            $contentReader->filter->andEqual($contentReader->model->dataId, $parentId);
            $parentRow = $contentReader->getRow();*/


            //$contentTypeSubject = $parentRow->contentType->getContentType();
            //$row->addText($contentTypeSubject->getSubject($parentRow->dataId));
            // $row->addText($contentTypeSubject->getLogText($parentRow->dataId));


            $row->addText($contentType->getSubject($inboxRow->dataId));

            $row->addText($inboxRow->user->displayName);
            $row->addText($inboxRow->dateTime->getShortDateTimeLeadingZeroFormat());


            $site = $contentType->getViewSite($inboxRow->dataId);

            if ($site !== null) {
                $row->addClickableSite($site);
            }


            if ($contentType->hasView()) {
                $view = $contentType->getView($stream);
                $view->dataId = $inboxRow->dataId;

                //$p = new Paragraph($stream);
                //$p->content = $contentTypeSubject->getClassName();


                (new Hr($stream));

            }

        }


        $page->render();

    }
}