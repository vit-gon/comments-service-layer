<?php

/**
 * If we it were a library, we would use it this way
 */
require_once 'vendor/autoload.php';

use VitGon\CommentsServiceLayer\Comment;
use VitGon\CommentsServiceLayer\CommentsRequestException;
use VitGon\CommentsServiceLayer\CommentsService;
use VitGon\CommentsServiceLayer\CurlRequest;


getAll();
create();
update();


function getAll()
{
  try
  {
    $curl_req = new CurlRequest();
    $comment_service = new CommentsService('http://glavsoft.loc', $curl_req);
    $comments = $comment_service->getAll(['company_id' => "1"]);
    print_r($comments);
  }
  catch (CommentsRequestException $ex)
  {
    print_r($ex);
  }
}

function create()
{
  try
  {
    $curl_req = new CurlRequest();
    $comment_service = new CommentsService('http://glavsoft.loc', $curl_req);
    $comments = $comment_service->create(new Comment(1, "David", "Welcome guys!"));
    print_r($comments);
  }
  catch (CommentsRequestException $ex)
  {
    print_r($ex);
  }
}

function update()
{
  try
  {
    $curl_req = new CurlRequest();
    $comment_service = new CommentsService('http://glavsoft.loc', $curl_req);
    $comments = $comment_service->update(new Comment(1, "David", "Welcome guys!"), $curl_req);
    print_r($comments);
  }
  catch (CommentsRequestException $ex)
  {
    print_r($ex);
  }
}