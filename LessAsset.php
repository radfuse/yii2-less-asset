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

    private $_less = false;

    public function publish($am){
        parent::publish($am);
        $this->publishLess($am);
    }

    private function publishLess($am){
        $src = \Yii::getAlias($this->basePath);
        
        if(!empty($this->less)){
            foreach($this->less as $lessFile){
                $srcFile = "$src/" . $this->sourceFolder . "/" . $lessFile . '.less';
                $destCss = $this->destinationFolder . "/" . $lessFile . ".css";
                $destFile = $this->basePath . "/" . $destCss;
                if(is_file($srcFile)){
                    $timeLess = filemtime($srcFile);
                    $timeCss = 0;
                    if(is_file($destFile))
				        $timeCss = filemtime($destFile);
			
                    if($timeCss != $timeLess){
                        if(is_file($destFile))
                            unlink($destFile);
                        if(!$this->_less){
                            $this->_less = new \lessc();
                            $this->_less->setFormatter(YII_DEBUG ? "lessjs" : "compressed");
                        }
                        
                        $this->_less->compileFile($srcFile, $destFile);
                        touch($destFile, $timeLess);
                    }
                    if(is_file($destFile))
                        $this->css[] = $destCss;
                }
            }
        }
    }
}
