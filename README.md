# comments-service-layer

## Description
Service layer for crud operations on comments

## How to use
Before start using run this in CMD:
```
C:\Users\User\Desktop> composer install
```
### CommentsService
| Return type | Method |
| --- | --- |
| array | getAll() |
| array | create(Comment $comment) |
| array | update(Comment $comment) |

```php
/**
 * If it were a library, we would use it this way
 */
require_once 'vendor/autoload.php';

use VitGon\CommentsServiceLayer\Comment;
use VitGon\CommentsServiceLayer\CommentsRequestException;
use VitGon\CommentsServiceLayer\CommentsService;
use VitGon\CommentsServiceLayer\CurlRequest;

create();

function create()
{
  try
  {
    $curl_req = new CurlRequest();
    $comment_service = new CommentsService('http://example.com', $curl_req);
    $comments = $comment_service->create(new Comment(1, "David", "Welcome guys!"));
    print_r($comments);
  }
  catch (CommentsRequestException $ex)
  {
    print_r($ex);
  }
}
```

## How to test
Go to project root and run in CMD:
```
C:\Users\User\Desktop> vendor\bin\phpunit tests\CommentServiceTest
```
