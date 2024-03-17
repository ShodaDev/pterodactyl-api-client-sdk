<?php

namespace shodadev\PterodactylClient\Manager;

use shodadev\PterodactylClient\Schemas\FileObject;

class FileManager extends Manager
{
   public function listFiles(string $id, string $directory)
   {
      return $this->request->get("servers/$id/files/list", ['directory' => $directory]);
   }

   public function getFilesContents(string $id, string $file)
   {
      return $this->request->get("servers/$id/files/contents", ['file' => $file]);
   }

   public function getFileDownloadUrl(string $id, string $file)
   {
      return $this->request->get("servers/$id/files/download", ['file' => $file]);
   }

   public function copyFile(string $id, string $file, string $location)
   {
      return $this->request->post("servers/$id/files/copy", ['file' => $file], ['location' => $location]);
   }

   public function writeFile(string $id, string $file, string $contents)
   {
      return $this->request->post("servers/$id/files/write", ['file' => $file], ['' => $contents]);
   }

   public function pullRemoteFile(string $id, string $url, string $directory, string $filename, string $use_header, bool $foreground)
   {
      return $this->request->post("servers/$id/files/pull", [], ['url' => $url, 'directory' => $directory, 'filename' => $filename, 'use_header' => $use_header, 'foreground' => $foreground]);
   }

   public function changeFilePermissions(string $id, string $root, array $files)
   {
      return $this->request->post("servers/$id/files/chmod", [], ['root' => $root, 'files' => $files]);
   }
   
   public function renameFiles(string $id, string $file, string $root, array $files)
   {
      return $this->request->put("servers/$id/files/rename", ['file' => $file], ['root' => $root, 'files' => $files]);
   }
   
}