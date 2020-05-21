<?php

namespace VitGon\CommentsServiceLayer;

use VitGon\CommentsServiceLayer\HttpRequest;


class CurlRequest implements HttpRequest
{
  private $handle = null;
  private $params = [];
  private $type;
  private $url;


  public function __construct() {
  }

  public function init() {
    $this->handle = curl_init();
    curl_setopt_array($this->handle, [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 300000,
      CURLOPT_HTTPHEADER, ['Accept: application/json'],
      CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36',
      CURLOPT_FAILONERROR => true
    ]);
  }

  public function setUrl($url) {
    $this->url = $url;
  }

  public function setType($type) {
    $this->type = $type;
  }

  public function setOption($name, $value) {
    curl_setopt($this->handle, $name, $value);
  }

  public function setOptions($options) {
    curl_setopt_array($this->handle, $options);
  }

  public function setParams($params) {
    $this->params = $params;
  }

  public function execute() {
    if ($this->type == 'GET') {
      if (count($this->params) > 0)
      {
        $this->url .= '?' . http_build_query($this->params);
      }
    }
    else if ($this->type == 'POST') {
      curl_setopt($this->handle, CURLOPT_POSTFIELDS, json_encode($this->params));
    }
    else if ($this->type == 'PUT') {
      curl_setopt($this->handle, CURLOPT_POSTFIELDS, http_build_query($this->params));
    }

    curl_setopt($this->handle, CURLOPT_URL, $this->url);
    curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, $this->type);
    return json_decode(curl_exec($this->handle));
  }

  public function getInfo($name) {
    return curl_getinfo($this->handle, $name);
  }

  public function getError() {
    return curl_error($this->handle);
  }

  public function close() {
    curl_close($this->handle);
    $this->handle = null;
    $this->params = [];
    $this->type = null;
    $this->url = null;
  }
}