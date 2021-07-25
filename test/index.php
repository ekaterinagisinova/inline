
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require 'db.php'; ?>

    <form action="download.php" >  
        <button>Загрузка постов и комментариев</button>  
    </form>

    <h2>Форма поиска</h2>
    <form action="" method="get">        
        <input type="text" name="find" placeholder="Введите поисковый запрос">
        <button name="btn">Найти</button>        
    </form>
    
    <?php

    $find = filter_var(trim($_GET['find']), FILTER_SANITIZE_STRING);
    $error = "";
    
    if(isset($_GET['btn'])) {
        if (strlen($find) < 3)      
            echo "Введите больше символов для поиска";
        else{
            echo "<h3>По запросу $find найдено: </h3>";
            $sql = 'SELECT post.id, comment.body, post.title FROM `post` JOIN `comment` ON comment.body LIKE "%'.$find.'%" AND comment.postID = post.id';
            $query = $pdo->query($sql);
            
            if (strlen($find) >= 3){
                
                while ($row = $query->fetch(PDO::FETCH_OBJ)){
                    echo '<p> id статьи -- '.$row->id.'</p>';
                    echo '<p> заголовок статьи -- '.$row->title.'</p> '; 
                    echo '<p> текст комментария -- '.$row->body.'</p> <hr>'; 
                }                
            }     
        }
    }
        
    ?>
</body>
</html>