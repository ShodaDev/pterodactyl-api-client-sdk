<?php

namespace shodadev\PterodactylClient\Schema;

class Collection extends Schema
{
   protected $attributes;

   protected $origin;

   protected $pterodactylClient;

   public function __construct(array $attributes, $pterodactylClient = null)
   {
      $attributes = isset($attributes['attributes']) ? $attributes['attributes'] : $attributes;

      $this->origin = $this->attributes = $attributes;

      $this->pterodactylClient = $pterodactylClient;
   }
}