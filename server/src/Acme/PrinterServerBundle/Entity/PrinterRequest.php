<?php
/**
 * Created by JetBrains PhpStorm.
 * User: hendrik
 * Date: 09/05/13
 * Time: 19:22
 * To change this template use File | Settings | File Templates.
 */


namespace Acme\PrinterServerBundle\Entity;

class PrinterRequest
{
  protected $text;

  public function getText()
  {
    return $this->text;
  }
  public function setText($text)
  {
    $this->text = $text;
  }
}
