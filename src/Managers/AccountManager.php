<?php

namespace shodadev\PterodactylClient\Managers;

use shodadev\PterodactylClient\Schemas\User;

class AccountManager extends Managers
{
   public function details()
   {
      return $this->request->get("account");
   }

   public function twoFactor()
   {
      return $this->request->get("account/two-factor");
   }

   public function getApiKeys()
   {
      return $this->request->get("account/api-keys");
   }

   public function getSSHKeys()
   {
      return $this->request->get("account/ssh-keys");
   }

   public function enableTwoFactor(string $code, string $password)
   {
      return $this->request->post("account/two-factor", [], ['code' => $code, 'password' => $password]);
   }

   public function createApiKey(string $description, string $allowed_ips)
   {
      return $this->request->post("account/api-keys", [], ['description' => $description, 'allowed_ips' => $allowed_ips]);
   }

   public function createSSHKey(string $name, string $public_key)
   {
      return $this->request->post("account/ssh-keys", [], ['name' => $name, 'public_key' => $public_key]);
   }

   public function removeSSHKey(string $fingerprint)
   {
      return $this->request->post("account/ssh-keys/remove", [], ['fingerprint' => $fingerprint]);
   }

   public function changeEmail(string $email, string $password)
   {
      return $this->request->put("account/email", [], ['email' => $email, 'password' => $password]);
   }

   public function changePassword(string $current_password, string $password, string $password_confirmation)
   {
      return $this->request->put("account/password", [], ['current_password' => $current_password, 'password' => $password, 'password_confirmation' => $password_confirmation]);
   }

   public function disableTwoFactor(string $password)
   {
      return $this->request->delete("account/two-factor", [], ['password' => $password]);
   }
   
   public function deleteApiKey(string $identifier)
   {
      return $this->request->delete("account/api-keys/$identifier");
   }
}