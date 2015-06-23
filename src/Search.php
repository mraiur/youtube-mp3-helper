<?php
namespace YoutubeHelper {
    class Search extends Core{
        private $songName;

        public function __construct( $songName ){
            parent::__construct();
            $this->songName = $songName;
        }

        public function run(){

            $client = $this->youtubeClient();

            $youtube = new \Google_Service_YouTube($client);

            try {
                $searchResponse = $youtube->search->listSearch('id,snippet', array(
                    'q' => urlencode($this->songName),
                    'maxResults' => 1,
                ));


                foreach ($searchResponse['items'] as $searchResult) {
                    switch ($searchResult['id']['kind']) {
                        case 'youtube#video':
                            return $searchResult['id']['videoId'];
                        break;
                    }
                }

          } catch (Google_Service_Exception $e) {
            $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
              htmlspecialchars($e->getMessage()));
          } catch (Google_Exception $e) {
            $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
              htmlspecialchars($e->getMessage()));
          }


        }

    }
}
