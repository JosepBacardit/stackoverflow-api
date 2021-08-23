<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StackOverflowController extends Controller
{
    public function __construct(Request $request) {
        $this->request = $request;
        $this->api_url = 'https://api.stackexchange.com/2.3/questions?site=stackoverflow';
    }

    public function questions($tagged, $fromDate = null, $toDate = null) {
        $response = [];
        try{
            $response['data'] = $this->getQuestions($tagged, $fromDate, $toDate);
            $response['success'] = true;
        }catch(\Exception $e){
            $response['success'] = false;
            $response['data'] = [];
            $response['message'] = $e->getMessage();
        }

        return json_encode($response);
    }


    /** PRIVATE FUNCTIONS */
    private function getQuestions($tagged, $fromDate, $toDate) {
        $url = $this->api_url.'&tagged='.$tagged;

        $url = (!is_null($fromDate)) ? $url.'&fromdate='.$fromDate : $url;
        $url = (!is_null($toDate)) ? $url.'&todate='.$toDate : $url;

        return Http::get($url)->json();
    }

}
