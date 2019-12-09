<?php

namespace System;
use DateTime;

abstract class Controller
{
  /**
   * Application Object
   *
   * @var \System\Application
   */
  protected $app;

  public function __construct(Application $app)
  {
    $this->app = $app;
  }

  /**
   * Call shared Application Objects dynamically
   *
   * @param string $key
   * @return mixed
   */
  public function __get($key)
  {
    return $this->app->get($key);
  }

  protected function changeFormatDate($date, array $format = ['Y-m-d H:i:s', 'd M Y | H:i'])
  {
    return $date ? DateTime::createFromFormat("$format[0]", $date)->format("$format[1]") : null;
  }

  protected function countries($country = 'all', $get = null)
  {
    $countries_icons = $this->file->call('config/icons.php')['flags'];
    if ($country === 'all') {
      if ($get === 'name') {
        return array_keys($countries_icons);
      } else if ($get === 'icon') {
        return array_values($countries_icons);
      } else {
        return $countries_icons;
      }
    }
    return($country && isset($countries_icons[$country])) ? $countries_icons[$country] : [];
  }
}
