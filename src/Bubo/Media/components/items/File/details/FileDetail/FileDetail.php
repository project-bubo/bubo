<?php

namespace Bubo\Media\Components\Items\File\Details;

final class FileDetail extends AbstractFileDetail {

    public function createComponentMediaFileSettingForm($name) {
        return new \BuboApp\AdminModule\Forms\MediaFileSettingForm($this, $name);
    }

    public function render() {
        $content = $this->lookup('Bubo\\Media\\Components\\Content');
        $media = $this->lookup('Bubo\\Media');

        $file = $this->presenter->mediaManagerService->loadFile($this->getId());

        $paths = $file->getPaths();

        $folderItem = $content->getFolderContentItem('files', $this->getId());

        $template = parent::initTemplate(__DIR__ . '/templates/'.$media->trigger.'.latte');

        //$template = parent::initTemplate(__DIR__ . '/templates/default.latte');
        $template->folderItem = $folderItem;
        $template->iconSrc = $this->presenter->mediaManagerService->getFileIconSrc($folderItem, 'detail');
        //$template->iconSrc =

        //$template->menu = $this->getMenu($folderItem);
        $template->render();


    }

}
