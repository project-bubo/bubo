<?php

namespace Bubo\Media\Components\Items\File\Details;

use Bubo\Application\UI\Control;

class AbstractFileDetail extends Control {
    
    public function getId() {
        $file = $content = $this->lookup('Bubo\\Media\\Components\\Items\\File');
        return $file->id;
    }

}
