<?php

namespace LLT\Controllers;


use LLT\Init\Controller;
use LLT\Init\Validator;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;

class ScheduleController extends Controller
{
    private $name, $phone, $email, $date;

    private $errorUserInput = [];

    private $client;

    public function __construct($method, $param)
    {
        parent::__construct($method, $param);
    }

    public function index()
    {


        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = Validator::name($_POST['name']);
            if(is_array($name)) {
                array_push($this->errorUserInput, $name);
            }else{
                $this->name = $name;
            }
            $phone = strip_tags($_POST['phone']);
            $email = strip_tags($_POST['email']);
            $date = strip_tags($_POST['date']);

            if(empty($this->errorUserInput)){
                $this->makeSchedule();
            }else{
                die(var_dump($this->errorUserInput));
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
            $service = new Google_Service_Calendar($this->client);

            $calendarId = 'primary';

            $results = $service->events->listEvents($calendarId);
            return $results->getItems();

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
                'summary' => "Još jedan test bez podataka",
                'description' => "valjda je uspelo",
                'start' => ['date' => '2020-08-30'],
                'end' => ['date' => '2020-09-01'],
                'reminders' => ['useDefault' => true],
            ]);
            $results = $service->events->insert($calendarId, $event);
            if (!$results) {
                //return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
                echo "došlo je do greške";
            }
            //return response()->json(['status' => 'success', 'message' => 'Event Created']);
            echo "napokon!";
        }
    }


}