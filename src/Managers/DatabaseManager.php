<?php

namespace shodadev\PterodactylClient\Managers;

use shodadev\PterodactylClient\Schemas\Database;

class DatabaseManager extends Managers
{
   public function getServerDatabases(string $id, array $query = [])
   {
      return $this->request->get("servers/$id/databases", $query);
   }

   public function createServerDatabase(string $id, string $database, string $remote)
   {
      return $this->request->post("servers/$id/databases", [], ['database' => $database, 'remote' => $remote]);
   }

   public function rotateDatabasePassword(string $id, string $database)
   {
      return $this->request->post("servers/$id/databases/$database/rotate-password");
   }

   public function deleteDatabase(string $id, string $database)
   {
      return $this->request->delete("servers/$id/databases/$database");
   }
}