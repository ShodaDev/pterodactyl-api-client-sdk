<?php

namespace shodadev\PterodactylClient\Managers;

use shodadev\PterodactylClient\Schemas\Backup;

class BackupManager extends Managers
{
   public function getServerBackups(string $id)
   {
      return $this->request->get("servers/$id/backups");
   }

   public function getBackup(string $id, string $backupId)
   {
      return $this->request->get("servers/$id/backups/$backupId");
   }

   public function downloadBackup(string $id, string $backupId)
   {
      return $this->request->get("servers/$id/backups/$backupId/download");
   }

   public function createBackup(string $id, string $name = "", bool $is_locked = false, array $ignored = [])
   {
      return $this->request->post("servers/$id/backups", [], ['name' => $name, 'is_locked' => $is_locked, 'ignored' => $ignored]);
   }

   public function lockBackup(string $id, string $backupId)
   {
      return $this->request->post("servers/$id/backups/$backupId/lock");
   }

   public function restoreBackup(string $id, string $backupId)
   {
      return $this->request->post("servers/$id/backups/$backupId/restore");
   }

   public function deleteBackup(string $id, string $backupId)
   {
      return $this->request->delete("servers/$id/backups/$backupId/delete");
   }
}