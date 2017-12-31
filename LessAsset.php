<?php

namespace radfuse\less;

use yii\web\AssetBundle;

/**
 * Less compiling asset bundle.
 */
class LessAsset extends AssetBundle
{
    public $sourceFolder = "less";
    public $destinationFolder = "css";
    public $less = [

    ];

    public function publish($am){
        parent::publish($am);
        $this->publishLess($am);
    }

    private function publishLess($am){
        $src = \Yii::getAlias($this->basePath);
        
        if(!empty($this->less)){
            foreach($this->less as $lessFile){
                if(is_file("$src/" . $this->sourceFolder . "/" . $lessFile . '.less')){
                    $less = new \lessc();
                    $less->setFormatter(YII_DEBUG ? "lessjs" : "compressed");
                    if(is_file($this->basePath . "/" . $this->destinationFolder . "/" . $lessFile . ".css"))
                        unlink($this->basePath . "/" . $this->destinationFolder . "/" . $lessFile . ".css");
                    $less->compileFile("$src/" . $this->sourceFolder . "/" . $lessFile . ".less", $this->basePath . "/" . $this->destinationFolder . "/" . $lessFile . ".css");
                }
            }
        }
    }
}
