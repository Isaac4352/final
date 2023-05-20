<?php
    class BDConfig{

        private string $bd;
        private string $host;
        private string $username;
        private string $pwd;
        private string $hash;
        private string $motor;

        public function __construct(string $bd, string $host, string $username, string $pwd, string $hash = 'utf8mb4', string $motor = 'mysql'){
            $this->bd = $bd;
            $this->host = $host;
            $this->username = $username;
            $this->pwd = $pwd;
            $this->hash = $hash;
            $this->motor = $motor;
        }
        
        public function getUsername() : string { return $this->username;}
        public function getPwd() : string { return $this->pwd;}
        public function getConnectionString() : string { return "$this->motor:dbname=$this->bd;host=$this->host;charset=$this->hash";}
        
    }

?>