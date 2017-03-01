<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class GoogleCalendarApiController extends Controller {

    private $auth_url;
    private $client;
    private $access_token;

    public function __construct() {
        
        $this->createClient();
        if (Session::has(GOOGLE_ACCESS_TOKEN)){
            Log::info ('Refreshing Token ...');
            $token = json_decode ( Session::get(GOOGLE_ACCESS_TOKEN) );            
            $this->client->refreshToken ($token->refresh_token);
            $this->access_token = $this->client->getAccessToken();
            Session::put(GOOGLE_ACCESS_TOKEN, json_encode($this->access_token));
        } else {            
            $this->access_token = NULL;
        }
    }
    
    public function createClient (){
        $this->client = new Google_Client();
        $this->client->setAuthConfig(config_path() . '/client_secret.json');
        $this->client->setAccessType("offline");        // offline access
        $this->client->setIncludeGrantedScopes(true);   // incremental auth
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
        $this->client->setRedirectUri(url('google_api/oauth2callback'));
        $this->auth_url = $this->client->createAuthUrl();
    }

    public function oauth2callback(Request $request) {
        if ($request->has(GOOGLE_CODE)) {
            $code = $request->input(GOOGLE_CODE);        
            $this->client->authenticate($code);
            $this->access_token = $this->client->getAccessToken();                        
            $request->session()->put(GOOGLE_ACCESS_TOKEN, json_encode($this->access_token));
            return $this->create ();
        }
    }
    
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        if (is_null ($this->access_token) ){
            Log::info ('Redireccionando ...');
            $url = filter_var($this->auth_url, FILTER_SANITIZE_URL);
            Session::put(REDIRECT_URI, $request->fullUrl());
            return Redirect::to($url);            
        }
        $service = new Google_Service_Calendar($this->client);
        $event = new Google_Service_Calendar_Event(array(
            'summary' => 'Google I/O 2015',
            'location' => '800 Howard St., San Francisco, CA 94103',
            'description' => 'A chance to hear more about Google\'s developer products.',
            'start' => array(
                'dateTime' => '2017-02-28T09:00:00-07:00',
                'timeZone' => 'America/Mexico_City',
            ),
            'end' => array(
                'dateTime' => '2017-02-28T17:00:00-07:00',
                'timeZone' => 'America/Mexico_City',
            ),
            'recurrence' => array(
                'RRULE:FREQ=DAILY;COUNT=2'
            ),
            'attendees' => array(
                array('email' => 'lpage@example.com'),
                array('email' => 'sbrin@example.com'),
            ),
            'reminders' => array(
                'useDefault' => FALSE,
                'overrides' => array(
                    array('method' => 'email', 'minutes' => 24 * 60),
                    array('method' => 'popup', 'minutes' => 10),
                ),
            ),
        ));
        
        //$calendarId = 'primary';        
        $calendarId = 'mexicox.gob.mx_eus964uf8l2lbbjns0g9m8n4hc@group.calendar.google.com';
        $event = $service->events->insert($calendarId, $event);
        printf('Event created: %s\n', $event->htmlLink);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
