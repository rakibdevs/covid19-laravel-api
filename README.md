## Laravel [Covid 19](https://rapidapi.com/api-sports/api/covid-193) API

![Packagist](https://img.shields.io/packagist/dt/rakibdevs/covid19-laravel-api)
[![GitHub stars](https://img.shields.io/github/stars/rakibdevs/covid19-laravel-api)](https://github.com/rakibdevs/covid19-laravel-api/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/rakibdevs/covid19-laravel-api)](https://github.com/rakibdevs/covid19-laravel-api/network)
[![GitHub issues](https://img.shields.io/github/issues/rakibdevs/covid19-laravel-api)](https://github.com/rakibdevs/covid19-laravel-api/issues)
[![GitHub license](https://img.shields.io/github/license/rakibdevs/covid19-laravel-api)](https://github.com/rakibdevs/covid19-laravel-api/blob/master/LICENSE)
[![Twitter](https://img.shields.io/twitter/url?style=social&url=https%3A%2F%2Fpackagist.org%2Fpackages%2Frakibdevs%2Fcovid19-laravel-api)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fpackagist.org%2Fpackages%2Frakibdevs%2Fcovid19-laravel-api)

 Laravel Covid19 API (covid19-laravel-api) is a Laravel package to connect Open Covid19 Map APIs ( https://rapidapi.com/api-sports/api/covid-193api ) and access free API services easily.

## Supported APIs
| APIs | Get data by | 
| --- | --- |
| [Statistics](https://covid-193.p.rapidapi.com/statistics) | By country [optional] |
| [Available Countries](https://covid-193.p.rapidapi.com/countries) | |
| [History](https://covid-193.p.rapidapi.com/history) | By country [Required], date [optional] |



## Installation

Install the package through [Composer](http://getcomposer.org).
On the command line:

```
composer require rakibdevs/covid19-laravel-api:'dev-master'

```


## Configuration 
If Laravel > 7, no need to add provider

Add the following to your `providers` array in `config/app.php`:

```php
'providers' => [
    // ...
    RakibDevs\Covid19\Covid19ServiceProvider::class,
],
'aliases' => [
    //...
    'Covid19' => RakibDevs\Covid19\Covid19::class,	
];


```


Publish the required package configuration file using the artisan command:
```
	$ php artisan vendor:publish
```
Edit the `config/openCovid19.php` file and modify the `api_key` value with your Open Covid19 Map api key.
```php
	return [
	    'api_key' 	        => ''
	];
```


## Usage
Here you can see some example of just how simple this package is to use.

```php
use RakibDevs\Covid19\Covid19;

$wt = new Covid19();

$info = $wt->getCurrentByCity('dhaka');    // Get current Covid19 by city name


```

### [Current Covid19](https://rapidapi.com/api-sports/api/covid-193current) 
Access current Covid19 data for any location on Earth including over 200,000 cities! [OpenCovid19](https://rapidapi.com/api-sports/api/covid-193) collect and process Covid19 data from different sources such as global and local Covid19 models, satellites, radars and vast network of Covid19 stations

```php

// By city name
$info = $wt->getCurrentByCity('dhaka'); 

// By city ID - download list of city id here http://bulk.openCovid19map.org/sample/
$info = $wt->getCurrentByCity(1185241); 

// By Zip Code - string with country code 
$info = $wt->getCurrentByZip('94040,us');  // If no country code specified, us will be default

// By coordinates : latitude and longitude
$info = $wt->getCurrentByCord(23.7104, 90.4074);

```

#### Output:
```
{
"get":"statistics"
"parameters":{
"country":"bangladesh"
}
"errors":[]
"results":1
"response":[
0:{
"continent":"Asia"
"country":"Bangladesh"
"population":165545725
"cases":{
"new":"+692"
"active":47562
"critical":NULL
"recovered":466064
"1M_pop":"3149"
"total":521382
}
"deaths":{
"new":"+22"
"1M_pop":"47"
"total":7756
}
"tests":{
"1M_pop":"20202"
"total":3344399
}
"day":"2021-01-10"
"time":"2021-01-10T05:30:06+00:00"
}
]
}

```

### [One Call API](https://rapidapi.com/api-sports/api/covid-193api/one-call-api) 
Make just one API call and get all your essential Covid19 data for a specific location with OpenCovid19 One Call API.

```php
// By coordinates : latitude and longitude
$info = $wt->getOneCallByCord(23.7104, 90.4074);

```

### [4 Day 3 Hour Forecast](https://rapidapi.com/api-sports/api/covid-193forecast5) 
4 day forecast is available at any location or city. It includes Covid19 forecast data with 3-hour step.

```php
// By city name
$info = $wt->get3HourlyByCity('dhaka'); 

// By city ID - download list of city id here http://bulk.openCovid19map.org/sample/
$info = $wt->get3HourlyByCity(1185241); 

// By Zip Code - string with country code 
$info = $wt->get3HourlyByZip('94040,us');  // If no country code specified, us will be default

// By coordinates : latitude and longitude
$info = $wt->get3HourlyByCord(23.7104, 90.4074);

```

### [5 Day Historical](https://rapidapi.com/api-sports/api/covid-193api/one-call-api#history) 
Get access to historical Covid19 data for the previous 5 days.

```php

// By coordinates : latitude, longitude and date
$info = $wt->getHistoryByCord(23.7104, 90.4074, '2020-01-09');

```

### [Air Pollution](https://rapidapi.com/api-sports/api/covid-193api/one-call-api#history) 
Air Pollution API provides current, forecast and historical air pollution data for any coordinates on the globe

Besides basic Air Quality Index, the API returns data about polluting gases, such as Carbon monoxide (CO), Nitrogen monoxide (NO), Nitrogen dioxide (NO2), Ozone (O3), Sulphur dioxide (SO2), Ammonia (NH3), and particulates (PM2.5 and PM10).

Air pollution forecast is available for 5 days with hourly granularity. Historical data is accessible from 27th November 2020.

```php

// By coordinates : latitude, longitude and date
$info = $wt->getAirPollutionByCord(23.7104, 90.4074);

```

### [Geocoding API](https://rapidapi.com/api-sports/api/covid-193api/one-call-api#history) 
Geocoding API is a simple tool that we have developed to ease the search for locations while working with geographic names and coordinates.
-> Direct geocoding converts the specified name of a location or area into the exact geographical coordinates;
-> Reverse geocoding converts the geographical coordinates into the names of the nearby locations.

```php
// By city name
$info = $wt->getGeoByCity('dhaka');

// By coordinates : latitude, longitude and date
$info = $wt->getGeoByCity(23.7104, 90.4074);

```





## License

Laravel Open Covid19 API is licensed under [The MIT License (MIT)](LICENSE).
