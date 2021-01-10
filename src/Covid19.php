<?php

namespace RakibDevs\Covid19;


/**
 * Covid19  API (covid19-laravel-api) is a Laravel package to connect COVID-19 API ( https://rapidapi.com/api-sports/api/covid-193/ ). COVID-19 is a completely FREE API that allows you to follow the progress of the coronavirus around the world.
 *
 * @package  covid19-laravel-api
 * @author   Md. Rakibul Islam <rakib1708@gmail.com>
 * @version  dev-master
 * @since    2021-01-10
 */

use RakibDevs\Covid19\Src\Exceptions\Covid19Exception;
use Illuminate\Support\Facades\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TooManyRedirectsException;

class Covid19
{
    /**
     * base endpoint : https://covid-193.p.rapidapi.com/. 
     *
     * @var string
     */

    protected $url  = 'https://covid-193.p.rapidapi.com/';

    /**
     * all statistics api endpoint : https://covid-193.p.rapidapi.com/statistics. 
     * 
     * @var string
     */

    protected $statistics = 'statistics?';

    /**
     * statistics by country api endpoint : https://covid-193.p.rapidapi.com/countries. 
     * 
     * @var string
     */

    protected $countries = 'countries?';

    /**
     * historical data api endpoint : https://covid-193.p.rapidapi.com/history. 
     *
     * @var string
     */

    protected $history = 'history?';


    

    protected $client;


    /**
     * Get a free  API key : https://rapidapi.com/api-sports/api/covid-193/pricing.
     *
     * @var string
     */

    protected $api_key;



    public function __construct()
    {
        $this->api_key          = Config::get('covid.api_key');
        $this->client = new Client([
            'base_uri' => $this->url,
            'timeout'  => 10.0,
        ]);
        $this->client->setDefaultOption('headers', 
            array(
                'x-rapidapi-key'  => $this->api_key,
                'x-rapidapi-host' => 'covid-193.p.rapidapi.com'
            )
        );

    }

    /**
     * build query parameters.
     *
     * @param array $params
     * @return string
     */

    private function buildParams(array $params)
    {
        $params['appid'] = $this->api_key;
        $params['units'] = $this->uom;
        $params['lang']  = $this->lang;

        return http_build_query($params);
    }


    /**
     * Get all current statistics for all countries
     * documentation : https://api-sports.io/documentation/covid-19/v1#tag/Statistics
     *
     * @param array $query
     * 
     */


    private function getStatisticsData(array $query)
    {
        try{
            $response = $this->client->request('GET', $this->statistics.$this->buildParams($query));
            if($response->getStatusCode() == 200){
                $res = json_decode($response->getBody()->getContents());
                return $res;
            }
        } 
        catch (ClientException | RequestException | ConnectException | ServerException | TooManyRedirectsException $e) {
            throw new Covid19Exception($e);
        }
    }

    /**
     * Get list of all available countries
     * documentation : https://api-sports.io/documentation/covid-19/v1#tag/Countries
     *
     * @param array $query
     * 
     */


    private function getCountriesData(array $query)
    {
        try{
            $response = $this->client->request('GET', $this->countries.$this->buildParams($query));
            if($response->getStatusCode() == 200){
                $res = json_decode($response->getBody()->getContents());
                return $res;
            }
        } 
        catch (ClientException | RequestException | ConnectException | ServerException | TooManyRedirectsException $e) {
            throw new Covid19Exception($e);
        }
    }

    /**
     * This endpoint refers to the entire history of statistics for a country.
     * A new entry is generated each time one of the data has evolved or regressed.
     * documentation : https://api-sports.io/documentation/covid-19/v1#tag/History
     *
     * @param array $query
     * 
     */


    private function getHistoryData(array $query)
    {
        try{
            $response = $this->client->request('GET', $this->history.$this->buildParams($query));
            if($response->getStatusCode() == 200){
                $res = json_decode($response->getBody()->getContents());
                return $res;
            }
        } 
        catch (ClientException | RequestException | ConnectException | ServerException | TooManyRedirectsException $e) {
            throw new Covid19Exception($e);
        }
    }


    public function getCountries(string $city = null)
    {
        return $this->getCountriesData(['search' => $city]);
    }

}
