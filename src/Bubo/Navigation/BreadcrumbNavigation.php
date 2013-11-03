<?php

namespace Bubo\Navigation;

use Bubo\Application\UI\Control;

abstract class BreadcrumbNavigation extends Control {

    public function __construct($parent, $name) {
        parent::__construct($parent, $name);
    }

}
