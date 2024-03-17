<?php

namespace shodadev\PterodactylClient\Managers;

use shodadev\PterodactylClient\Schemas\Collection;
use shodadev\PterodactylClient\Schemas\Server;
use shodadev\PterodactylClient\Schemas\Stats;


class ServerManager extends Managers
{
   public function paginate(int $page = 1, array $query = [])
   {
      return $this->request->get("", array_merge(['page' => $page], $query));
   }

   public function getDetails(string $id, array $query = [])
   {
      return $this->request->get("servers/$id", $query);
   }

   public function getWebsocket(string $id)
   {
      return $this->request->get("servers/$id/websocket");
   }

   public function getResourceUsage(string $id)
   {
      return $this->request->get("servers/$id/resources");
   }

   public function getStartup(string $id)
   {
      return $this->request->get("servers/$id/startup");
   }

   public function sendCommand(string $id, string $command)
   {
      return $this->request->post("servers/$id/command", [], ['command' => $command]);
   }

   public function sendPowerActions(string $id, string $signal)
   {
      return $this->request->post("servers/$id/power", [], ['signal' => $signal]);
   }

   public function rename(string $id, string $name)
   {
      return $this->request->post("servers/$id/settings/rename", [], ['name' => $name]);
   }

   public function reinstall(string $id)
   {
      return $this->request->post("servers/$id/settings/reinstall", [], []);
   }

   public function updateDockerImage(string $id, string $docker_image)
   {
      return $this->request->post("servers/$id/settings/docker-image", [], ['image' => $docker_image]);
   }

   public function updateVariable(string $id, string $key, string $value)
   {
      return $this->request->put("servers/$id/startup/variable", [], ['key' => $key, 'value' => $value]);
   }
}