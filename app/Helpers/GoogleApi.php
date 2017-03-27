<?php
namespace App\Helpers;

use Google_Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class GoogleApi {
    
    /**    
    * @var Google_Client
    */
    private $client;
    private $access_token;
    private $auth_url;
    
    public function __construct($scopes) {        
        $this->client = new Google_Client();
        $this->client->setAuthConfig(config_path() . '/client_secret.json');
        $this->client->setAccessType("offline");        // offline access
        $this->client->setIncludeGrantedScopes(true);   // incremental auth
        foreach ($scopes as $scope){
            $this->client->addScope($scope);
        }
        
        $this->client->setRedirectUri(url('google_api/oauth2callback'));
        $this->auth_url = $this->client->createAuthUrl();
        $this->access_token = NULL;
//        if (Session::has(GOOGLE_ACCESS_TOKEN)){
//            Log::info ('Refreshing Token ...');
//            $token = json_decode ( Session::get(GOOGLE_ACCESS_TOKEN) ); 
//            if ( !is_null($token) ) {
//                $this->client->refreshToken ($token->refresh_token);
//                $this->setAccessToken($this->client->getAccessToken());
//            }            
//        }         
    }    
    
    public function goLogin (){
        Session::put(REDIRECT_URI, \Illuminate\Support\Facades\Request::fullUrl());
        return Redirect::to($this->getAuthUrl());
    }
    
    public function isLoggedIn (){
        return ! is_null ($this->access_token);
    }
    
    public function authenticate ($code){
        $this->client->authenticate($code);        
        $this->setAccessToken( $this->client->getAccessToken() );
    }
    
    public function setAuthUrl ($value){ $this->auth_url = $value; }
    public function getAuthUrl () { return $this->auth_url; }
    
    public function setClient ($value){ $this->client = $value; }
    public function getClient (){ return $this->client; }
    
    public function setAccessToken ($value){ 
        $this->access_token = $value; 
        Session::put(GOOGLE_ACCESS_TOKEN, json_encode($this->access_token));
    }
    public function getAccessToken (){ return $this->access_token; }
}