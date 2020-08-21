<?php

namespace LLT\Controllers;


use LLT\Init\Controller;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;

class ScheduleController extends Controller
{
    private $client;

    public function __construct($method, $param)
    {
        parent::__construct($method, $param);
    }

    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            /* If honeypot is sent in the request - it is a script/bot */
            if($_POST['honeypot'] === '') {
                $name = strip_tags($_POST['name']);
                $phone = strip_tags($_POST['phone']);
                $email = strip_tags($_POST['email']);
                $start = strip_tags($_POST['start']);
                $end = strip_tags($_POST['end']);

                $_SESSION['name']  = $name;
                $_SESSION['phone'] = $phone;
                $_SESSION['email'] = $email;
                $_SESSION['start-datetime'] = $start;
                $_SESSION['end-datetime']   = $end;

                $this->makeSchedule();
            }else{
                die('it is a bot!');
            }

        }else{
            $this->view->load('404');
        }
    }

    public function makeSchedule()
    {
        $client = new Google_Client();
        $client->setAuthConfig(VIEWS . 'credentials.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        $this->client = $client;

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);

            $this->storeEvent();

        }else{
            $rurl = "http://localhost:3000/schedule/makeSchedule/";
            $this->client->setRedirectUri($rurl);
            if (!isset($_GET['code'])) {
                $auth_url = $this->client->createAuthUrl();
                $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);

                header('Location: ' . $filtered_url);
            } else {
                $this->client->authenticate($_GET['code']);
                $_SESSION['access_token'] = $this->client->getAccessToken();

                $this->storeEvent();

            }
        }
    }

    public function storeEvent(){

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            $calendarId = 'primary';
            $event = new Google_Service_Calendar_Event([
                'summary' => "Event created: User {$_SESSION['name']}",
                'description' => "<h2>Created by {$_SESSION['name']}</h2><h4>Email: {$_SESSION['email']}</h4><h4>Phone: {$_SESSION['phone']}</h4>",
                'start' => [
                    'dateTime' => "{$_SESSION['start-datetime']}",
                    'timeZone' => 'America/Los_Angeles'
                ],
                'end' => [
                    'dateTime' => "{$_SESSION['end-datetime']}",
                    'timeZone' => 'America/Los_Angeles'
                ],
                'reminders' => [
                        'useDefault' => false,
                        'overrides' => [
                            ['method' => 'email', 'minutes' => '30'],
                            ['method' => 'email', 'minutes' => '15']
                        ]
                    ],
                'visibility' => "public"
            ]);
            $results = $service->events->insert($calendarId, $event);
            if (!$results) {
                $this->view->load('error');
            }else{
                try{
                    mail($_SESSION['email'], 'Event created', 'You have successfully created event');
                }catch (\Exception $e){
                    // log error message;
                    $error = $e->getMessage();
                };
                $this->view->load('success');
            }

        }
    }


}