<?php

namespace shodadev\PterodactylClient\Schemas;

class Server extends Schemas
{
   public function details()
   {
      $this->pterodactylClient->server->getDetails($this->identifier);
   }

   public function websocket()
   {
      $this->pterodactylClient->server->getWebsocket($this->identifier);
   }

   public function resources()
   {
      $this->pterodactylClient->server->getResourceUsage($this->identifier);
   }

   public function startup()
   {
      $this->pterodactylClient->server->getStartup($this->identifier);
   }

   public function command(string $command)
   {
      $this->pterodactylClient->server->sendCommand($this->identifier, $command);
   }

   public function power(string $signal)
   {
      $this->pterodactylClient->server->sendPowerActions($this->identifier, $signal);
   }

   public function rename(string $name)
   {
      $this->pterodactylClient->server->rename($this->identifier, $name);
   }

   public function dockerImage(string $docker_image)
   {
      $this->pterodactylClient->server->updateDockerImage($this->identifier, $docker_image);
   }

   public function updateVariable(string $key, string $value)
   {
      $this->pterodactylClient->server->updateVariable($this->identifier, $key, $value);
   }
}