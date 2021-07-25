<a href="/index.php">Назад</a>
<?php
    require 'db.php';
// Загрузка в БД постов 

    $postJSON = file_get_contents('https://jsonplaceholder.typicode.com/posts');

    $objPost = json_decode($postJSON);
    $countPost = 0;
    foreach ($objPost as $el) {
        $sql = 'INSERT INTO `post`(userID, id, title, body) VALUES (:userId, :id, :title, :body)';
        $query = $pdo->prepare($sql);
        $query->execute(['userId' => $el->userId, 'id' => $el->id, 'title' => $el->title, 'body' => $el->body]);
        $countPost++;
    }
    echo '<p>Загружено постов - '.$countPost.'</p>' ;

// Загрузка в БД комментариев 

    $commentJSON = file_get_contents('https://jsonplaceholder.typicode.com/comments');

    $objComment = json_decode($commentJSON);
    $countComment = 0;
    foreach ($objComment as $el) {
        $sql = 'INSERT INTO `comment`(postID, id, name, email, body) VALUES (:postID, :id, :name, :email, :body)';
        $query = $pdo->prepare($sql);
        $query->execute(['postID' => $el->postId, 'id' => $el->id, 'name' => $el->name, 'email' => $el->email, 'body' => $el->body]);
        $countComment++;
    }
    echo '<p>Загружено комментариев - '.$countComment.'</p>' ;
?>