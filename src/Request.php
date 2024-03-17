<?php

namespace shodadev\PterodactylClient;

use GuzzleHttp\Client;

class Request
{
   /*
   * Pterodactyl Client Instance
   * 
   * @var PterodactylClient
   */
   protected $pterodactylClient;
   
   /*
   * Pterodactyl Base URI
   * 
   * @var string
   */
   protected string $baseUri;

   /*
   * Pterodactyl Client Api Key
   * 
   * @var string
   */
   protected string $apiKey;

   /*
   * Guzzle Client Instance
   * 
   * @var Client
   */
   protected $guzzle;

   /*
   * Request Timeout
   * 
   * @var int
   */
   protected int $timeout = 35;

   public function __construct(PterodactylClient $pterodactylClient, Client $guzzle = null)
   {
      $this->pterodactylClient = $pterodactylClient;

      $this->baseUri = $this->pterodactylClient->baseUri;

      $this->apiKey = $this->pterodactylClient->apiKey;

      $this->guzzle = $guzzle ?: new Client([
         'base_uri' => $this->baseUri,
         'http_errors' => false,
         'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
         ],
      ]);

      return $this;
   }

   /*
   * Send a GET request
   * 
   * @param string $uri
   * 
   * @param array $query
   * 
   * @return mixed
   */
   public function get(string $uri, array $query = []): mixed
   {
      return $this->request('GET', $uri, $query);
   }

   /*
   * Send a POST request
   * 
   * @param string $uri
   * 
   * @param array $query
   * 
   * @param array $data
   * 
   * @return mixed
   */
   public function post(string $uri, array $query = [], array $data = []): mixed
   {
      return $this->request('POST', $uri, $query, $data);
   }

   /*
   * Send a PATCH request
   * 
   * @param string $uri
   * 
   * @param array $query
   * 
   * @param array $data
   * 
   * @return mixed
   */
   public function patch(string $uri, array $query = [], array $data = []): mixed
   {
      return $this->request('PATCH', $uri, $query, $data);
   }

   /*
   * Send a PUT request
   * 
   * @param string $uri
   * 
   * @param array $query
   * 
   * @param array $data
   * 
   * @return mixed
   */
   public function put(string $uri, array $query = [], array $data = []): mixed
   {
      return $this->request('PUT', $uri, $query, $data);
   }

   /*
   * Send a DELETE request
   * 
   * @param string $uri
   * 
   * @param array $query
   * 
   * @return mixed
   */
   public function delete(string $uri, array $query = []): mixed
   {
      return $this->request('DELETE', $uri, $query);
   }

   /*
   * Send a request and return response
   * 
   * @param string $method
   * 
   * @param string $uri
   * 
   * @param array $query
   * 
   * @param array $data
   * 
   * @return mixed
   */
   public function request(string $method, $uri, array $query = [], array $data = []): mixed
   {
   
      $finalUri = $this->baseUri . '/api/client/' . $uri;

      $body = json_encode($data);

      $authkey = $this->apiKey;

      $settings = array();

      $settings['query'] = $query;
      $settings['body'] = $body;
      $settings['headers']['Authorization'] = 'Bearer ' . $authkey;

      $response = $this->guzzle->request($method, $finalUri, $settings);

      $responseBody = $response->getBody();

      return $this->transformResponse(json_decode($responseBody, true)) ?: $responseBody;
   }

   /*
   * Transform response
   * 
   * @param mixed $response
   * 
   * @return mixed
   */
   protected function transformResponse($response): mixed
   {
      if(empty($response['object'])) {
         return $response;
      }

      if($response['object'] == 'list') {
         $response['data'] = array_map([$this, 'transformResponse'], $response['data']);
         $response['object'] = 'collection';
      }

      if (isset($response['attributes']['relationships'])) {
         $response['attributes']['relationships'] = array_map([$this, 'transformResponse'], $response['attributes']['relationships']);
      }

      $object = ucwords($this->camelCase($response['object']));

      
      $class = '\\shodadev\\PterodactylClient\\Schemas\\'.$object;
      $finalResponse = class_exists($class) ? new $class($response, $this->pterodactylClient) : $response;

      return $finalResponse;
   }

   /*
   * Convert snake_case to camelCase
   * 
   * @param string $key
   * 
   * @return string
   */
   private function camelCase($key)
   {
      $parts = explode('_', $key);

      foreach ($parts as $i => $part) {
         if ($i !== 0) {
            $parts[$i] = ucfirst($part);
         }
      }

      return str_replace(' ', '', implode(' ', $parts));
   }

   /*
   * Set request timeout
   * 
   * @param int $timeout
   * 
   * @return $this
   */
   public function setTimeout($timout): this
   {
      $this->timeout = $timout;

      return $this;
   }

   /*
   * Get request timeout
   * 
   * @return int
   */
   public function getTimeout(): int
   {
      return $this->timeout;
   }
}