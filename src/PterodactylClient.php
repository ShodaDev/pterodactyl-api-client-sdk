<?php

namespace shodadev\PterodactylClient;

use GuzzleHttp\Client as Client;
use shodadev\PterodactylClient\Managers\AccountManager;
use shodadev\PterodactylClient\Managers\BackupManager;
use shodadev\PterodactylClient\Managers\DatabaseManager;
use shodadev\PterodactylClient\Managers\FileManager;
use shodadev\PterodactylClient\Managers\ServerManager;

class PterodactylClient
{
   public function __construct($baseUri, $apiKey, Client $guzzle = null)
   {
      $this->baseUri = $baseUri;
      $this->apiKey = $apiKey;

      $this->request = new Request($this, $guzzle);

      $this->account = new AccountManager($this);
      $this->backup = new BackupManager($this);
      $this->database = new BackupManager($this);
      $this->file = new FileManager($this);
      $this->server = new ServerManager($this);
   }
}