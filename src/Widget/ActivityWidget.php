<?php


namespace Nemundo\Process\Widget;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Admin\Com\Table\AdminTableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\User\Session\UserSession;

class ActivityWidget extends AdminWidget
{

    public function getContent()
    {

        $this->widgetTitle = 'Activity Stream';

        $contentReader = new ContentReader();
        $contentReader->model->loadContentType();
        $contentReader->model->loadUser();
        $contentReader->filter->andEqual($contentReader->model->userId, (new UserSession())->userId);
        $contentReader->addOrder($contentReader->model->id, SortOrder::DESCENDING);
        $contentReader->limit = 20;


        $table = new AdminClickableTable($this);

        $header = new AdminTableHeader($table);
        $header->addText('Source');
        $header->addText('Subject');
        $header->addText('Type');

        $header->addText('Date/Time');

        foreach ($contentReader->getData() as $contentRow) {

            $contentType = $contentRow->getContentType();


            $row = new BootstrapClickableTableRow($table);

            if ($contentType->hasParent()) {
                $parentContentType = $contentType->getParentContentType();
                $row->addText($parentContentType->getSubject());
            } else {
                $row->addEmpty();
            }


            $row->addText($contentRow->subject);
            //$row->addText($contentType->getSubject());
            $row->addText($contentRow->contentType->contentType);

            $row->addText($contentRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            $row->addText($contentRow->user->login);

            if ($contentType->hasViewSite()) {
                $row->addClickableSite($contentType->getViewSite());
            }

        }


        return parent::getContent(); // TODO: Change the autogenerated stub
    }

}