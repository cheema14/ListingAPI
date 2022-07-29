<?php

class DataClass {

    public $endpoint;
    public $params = array();
    public $url;
    
    public $all_data_arr = array();


    function __construct($endpoint,$params,$url){

        $this->endpoint = $endpoint;
        $this->params = $params;
        $this->url = $url;

    }

    public function fetch_data_from_api(){
        
        $data =  $this->hit_curl_request();
        
        
        
        $this->death_dump($data);
    }

    private function hit_curl_request(){

        
        $curl = curl_init($this->url);
        
        curl_setopt($curl,CURLOPT_URL,$this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        
        $response = curl_exec($curl);

        curl_close($curl);

        $decode_response = json_decode($response,true);
        
        
        while($decode_response['next_page_url'] != null){

            $next_page = $decode_response['next_page_url'];

            $np = parse_url($next_page);
            
            $query_params = explode('&',$np['query']);
            

            $apiKey = explode('=',$query_params[0]);
            $apiKey = $apiKey[1];
            
            $pge = explode('=',$query_params[1]);
            $pge = $pge[1];
            
            $nPage = explode('=',$query_params[2]);
            $nPage = $nPage[1];

            
            $this->params = array('api_key'=>$apiKey,'page'=>$pge,'page["number"]'=>$nPage);
            $this->url = $this->endpoint.'?'. http_build_query($this->params);
            
            $this->all_data_arr[] = $decode_response;
            
            $decode_response = '';

            $this->hit_curl_request();
        }

            return $this->all_data_arr;

        
    }


    public function death_dump($arr){
        echo "<pre>";
        print_r($arr);
        die;
    }

} // end class

