<?php

namespace shodadev\PterodactylClient\Managers;

use shodadev\PterodactylClient\Request;
use shodadev\PterodactylClient\PterodactylClient;

class Managers
{
   public $pterodactylClient;

   public $request;

   public function __construct(PterodactylClient $pterodactylClient)
   {
      $this->pterodactylClient = $pterodactylClient;

      $this->request = $this->pterodactylClient->request;
   }
}