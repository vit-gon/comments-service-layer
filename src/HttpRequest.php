<?php

namespace VitGon\CommentsServiceLayer;

interface HttpRequest
{
  public function init();
  public function setOption($name, $value);
  public function setOptions($options);
  public function setUrl($url);
  public function setType($type);
  public function setParams($params);
  public function execute();
  public function getInfo($name);
  public function getError();
  public function close();
}