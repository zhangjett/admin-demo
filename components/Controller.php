<?php

namespace app\components;

use yii;

class Controller extends yii\web\Controller
{
    public $cssFile = [];

    public $jsFile = [];

    public function getCssFile()
    {
        return $this->cssFile;
    }

    public function getJsFile()
    {
        return $this->jsFile;
    }

}
