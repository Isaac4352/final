<?php
abstract class Controller{
    protected BDConfig $configBD;

    public function __construct(BDConfig $configBD){
        $this->configBD = $configBD;
    }
    abstract function default();
}
?>