<?php

use PHPUnit\Framework\TestCase;
use VitGon\CommentsServiceLayer\Comment;
use VitGon\CommentsServiceLayer\CommentsRequestException;
use VitGon\CommentsServiceLayer\CommentsService;
use VitGon\CommentsServiceLayer\CurlRequest;

CONST HOST = 'http://example.com';

class CommentServiceTest extends TestCase
{
  public function testIsThereAnySyntaxError()
  {
    $curl_req_mock = $this->createMock(CurlRequest::class);
    $comment_service = new CommentsService(HOST, $curl_req_mock);
    $this->assertTrue(is_object($comment_service));
    unset($comment_service);
  }

  public function testGetAllMethod()
  {
    $curl_req_mock = $this->createMock(CurlRequest::class);
    $comment_service = new CommentsService(HOST, $curl_req_mock);
    $curl_req_mock
      ->method('execute')
      ->willReturn("cURL response");

    $curl_req_mock
      ->expects($this->once())
      ->method('execute')
      ->with();

    $curl_req_mock
      ->expects($this->once())
      ->method('setUrl')
      ->with(HOST . "/comments");

    $curl_req_mock
      ->expects($this->once())
      ->method('setType')
      ->with("GET");

    $curl_req_mock
      ->expects($this->once())
      ->method('setParams')
      ->with([]);

    // test curl request
    $this->assertTrue($comment_service->getAll() == "cURL response");
    unset($comment_service);
  }

  public function testCreateMethod()
  {
    $curl_req_mock = $this->createMock(CurlRequest::class);
    $comment_service = new CommentsService(HOST, $curl_req_mock);
    $curl_req_mock
      ->method('execute')
      ->willReturn("cURL response");

    $curl_req_mock
      ->expects($this->once())
      ->method('execute')
      ->with();

    $curl_req_mock
      ->expects($this->once())
      ->method('setUrl')
      ->with(HOST . "/comment");

    $curl_req_mock
      ->expects($this->once())
      ->method('setType')
      ->with("POST");

    $curl_req_mock
      ->expects($this->once())
      ->method('setParams')
      ->with(['id' => 1, 'name' => "David", 'text' => "Good morning!"]);
    
    // test curl request
    $comment = new Comment(1, "David", "Good morning!");
    $this->assertTrue($comment_service->create($comment) == "cURL response");
    unset($comment_service);
  }

  public function testUpdateMethod()
  {
    $curl_req_mock = $this->createMock(CurlRequest::class);
    $comment_service = new CommentsService(HOST, $curl_req_mock);
    $comment = new Comment(1, "David", "Good morning!");
    $curl_req_mock
      ->method('execute')
      ->willReturn("cURL response");

    $curl_req_mock
      ->expects($this->once())
      ->method('execute')
      ->with();

    $curl_req_mock
      ->expects($this->once())
      ->method('setUrl')
      ->with(HOST . "/comment/1");

    $curl_req_mock
      ->expects($this->once())
      ->method('setType')
      ->with("PUT");

    $curl_req_mock
      ->expects($this->once())
      ->method('setParams')
      ->with(['name' => "David", 'text' => "Good morning!"]);
    
    // test curl request
    
    $this->assertTrue($comment_service->update($comment) == "cURL response");
    unset($comment_service);
  }


  public function testGetAllMethodThrowCommentsRequestException()
  {
    $curl_req_mock = $this->createMock(CurlRequest::class);
    $comment_service = new CommentsService(HOST, $curl_req_mock);
    $curl_req_mock
      ->method('getError')
      ->willReturn("cURL error");

    $this->expectException(CommentsRequestException::class);
    $comment_service->getAll();
    unset($comment_service);
  }

  public function testCreateMethodThrowCommentsRequestException()
  {
    $curl_req_mock = $this->createMock(CurlRequest::class);
    $comment_service = new CommentsService(HOST, $curl_req_mock);
    $curl_req_mock
      ->method('getError')
      ->willReturn("cURL error");
    $this->expectException(CommentsRequestException::class);

    $comment = new Comment(1, "David", "Good morning!");
    $comment_service->create($comment);
    unset($comment_service);
  }

  public function testUpdateMethodThrowCommentsRequestException()
  {
    $curl_req_mock = $this->createMock(CurlRequest::class);
    $comment_service = new CommentsService(HOST, $curl_req_mock);
    $curl_req_mock
      ->method('getError')
      ->willReturn("cURL error");
    $this->expectException(CommentsRequestException::class);

    $comment = new Comment(1, "David", "Good morning!");
    $comment_service->update($comment);
    unset($comment_service);
  }
}