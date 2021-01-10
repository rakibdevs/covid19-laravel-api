## Laravel [Covid 19](https://rapidapi.com/api-sports/api/covid-193) API

![Packagist](https://img.shields.io/packagist/dt/rakibdevs/covid19-laravel-api)
[![GitHub stars](https://img.shields.io/github/stars/rakibdevs/covid19-laravel-api)](https://github.com/rakibdevs/covid19-laravel-api/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/rakibdevs/covid19-laravel-api)](https://github.com/rakibdevs/covid19-laravel-api/network)
[![GitHub issues](https://img.shields.io/github/issues/rakibdevs/covid19-laravel-api)](https://github.com/rakibdevs/covid19-laravel-api/issues)
[![GitHub license](https://img.shields.io/github/license/rakibdevs/covid19-laravel-api)](https://github.com/rakibdevs/covid19-laravel-api/blob/master/LICENSE)
[![Twitter](https://img.shields.io/twitter/url?style=social&url=https%3A%2F%2Fpackagist.org%2Fpackages%2Frakibdevs%2Fcovid19-laravel-api)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fpackagist.org%2Fpackages%2Frakibdevs%2Fcovid19-laravel-api)

 Laravel Covid-19 API (covid19-laravel-api) is a Laravel package to connect Open Covid-19  APIs ( https://rapidapi.com/api-sports/api/covid-193 ) and access free API services easily.

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
composer require rakibdevs/covid19-laravel-api

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

Get an api key [here](https://rapidapi.com/api-sports/api/covid-193/pricing)
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

$info = $wt->getCountries('ban');    // Get current Covid19 by city name


```

### Output
```
{
    "get":"countries"
    "parameters":{
        "search":"ban"
    }
    "errors":[]
    "results":3
    "response":[
        0:"Albania"
        1:"Bangladesh"
        2:"Lebanon"
    ]
}
```

### [Available Countries](https://rapidapi.com/api-sports/api/covid-193) 
Get all current statistics for all countries

```php

// By country name or portion of string
$info = $wt->getCountries('ban'); 

// Get all countries
$info = $wt->getAllCountries(); 

```

#### Output:
```
{
    "get":"countries"
    "parameters":[]
    "errors":[]
    "results":225
    "response":[
        0:"Afghanistan"
        1:"Albania"
        ........
    ]
}

```
### [Statistics](https://api-sports.io/documentation/covid-19/v1#tag/Statistics) 
This endpoint reflects the current status of the spread of the coronavirus in all countries.

It is possible to filter per country to retrieve its current status.

For the current situation in the world use `All`

```php
// By country name
$info = $wt->getStatistics(); 

// Get statistics
$info = $wt->getAllStatistics(); 

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



### [History](https://rapidapi.com/api-sports/api/covid-193forecast5) 
This dunction refers to the entire history of statistics for a country.

For global results, use .

```php
// By country name [required] and date
$info = $wt->getHistory('bangladesh', '2020-01-01'); 


```

### Output
```
{
    "get":"history"
    "parameters":{
        "country":"Bangladesh"
        "day":"2020-06-02"
    }
    "errors":[]
    "results":1
    "response":[
        0:{
            "continent":"Asia"
            "country":"Bangladesh"
            "population":164551275
            "cases":{
                "new":"+2381"
                "active":38265
    ....
```

### Worldwide Summary
Get Covid-19 worldwide summary till current date.

```php

$info = $wt->getSummary();

```
### Output
```
{
    "cases_new": 777635
    "cases_active": 67908362
    "cases_critical": 325531
    "cases_recovered": 193258167
    "cases_total": 270304615
    "deaths_new": 14668
    "deaths_total": 5805634
    "tests_total": 1282221510
    "time": "2020-03-25T06:00:07+00:00"
}
```

## License

Laravel Open Covid19 API is licensed under [The MIT License (MIT)](LICENSE).
