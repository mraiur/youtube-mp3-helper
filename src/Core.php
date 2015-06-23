<?php
use Piwik\Ini;

namespace YoutubeHelper{
    class Core{
        private $config;

        public function __construct(){

            $config = new \Piwik\Ini\IniReader();
            $configData  = $config->readFile('./.env');

            $this->config = $configData;

        }


        protected function getAPIkey(){
            return $this->config['YOUTUBE']['API_KEY'];
        }


        protected function youtubeClient(){

            $client = new \Google_Client();
            $client->setDeveloperKey( $this->getAPIkey() );

            return $client;

        }

    }
}
