<?php

namespace VitGon\CommentsServiceLayer;

class Comment
{
  private $id;
  private $name;
  private $text;

  public function __construct(int $id, string $name, string $text)
  {
    $this->id = $id;
    $this->name = $name;
    $this->text = $text;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function getText()
  {
    return $this->text;
  }

  public function setText(string $text)
  {
    $this->text = $text;
  }
}