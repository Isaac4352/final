<?php
    class Connection{
        protected BDConfig $config;
        protected ?PDO $connect;

        public function __construct(BDConfig $config){
            $this->config = $config;
            $this->connect = new PDO(
                $this->config->getConnectionString(),
                $this->config->getUsername(),
                $this->config->getPwd()
            );
        }

        public function getConfig() : BDConfig { return $this->config;}

        function __destruct() {$this->connect = null;}
    }
?>