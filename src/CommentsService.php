<?php

namespace VitGon\CommentsServiceLayer;

CONST GET_ALL_URL = '/comments';
CONST CREATE_URL = '/comment';
CONST UPDATE_URL = '/comment';


class CommentsService
{
  private $host;
  private $request;

  public function __construct(string $host, HttpRequest $request)
  {
    $this->host = $host;
    $this->request = $request;
  }

  public function getAll($params = [])
  {
    $url = $this->host . GET_ALL_URL;

    $this->request->init();
    $this->request->setUrl($url);
    $this->request->setType('GET');
    $this->request->setParams($params);
    $response = $this->request->execute();
    $error = $this->request->getError();
    $status_code = $this->request->getInfo(CURLINFO_HTTP_CODE);
    $this->request->close();

    if ($error != null)
    {      
      throw new CommentsRequestException($error, $status_code);
    }
    return $response;
  }

  public function create(Comment $comment)
  {
    $url = $this->host . CREATE_URL;

    $post_body = [
      'id' => $comment->getId(),
      'name' => $comment->getName(),
      'text' => $comment->getText()
    ];

    $this->request->init();
    $this->request->setUrl($url);
    $this->request->setType('POST');
    $this->request->setParams($post_body);
    $response = $this->request->execute();
    $error = $this->request->getError();
    $status_code = $this->request->getInfo(CURLINFO_HTTP_CODE);
    $this->request->close();

    if ($error != null)
    {
      throw new CommentsRequestException($error, $status_code);
    }
    return $response;
  }

  public function update(Comment $comment)
  {
    $url = $this->host . UPDATE_URL . "/{$comment->getId()}";

    $post_body = [  
      'name' => $comment->getName(),
      'text' => $comment->getText()
    ];

    $this->request->init();
    $this->request->setUrl($url);
    $this->request->setType('PUT');
    $this->request->setParams($post_body);
    $response = $this->request->execute();
    $error = $this->request->getError();
    $status_code = $this->request->getInfo(CURLINFO_HTTP_CODE);
    $this->request->close();

    if ($error != null)
    {
      throw new CommentsRequestException($error, $status_code);
    }
    return $response;
  }
}