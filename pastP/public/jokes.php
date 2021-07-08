<?php

    try{
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/UpgradeDatabaseFunctions.php';

        /* 기존 코드        
        $sql = 'SELECT `joke`.`id`, `joketext`, `name`, `email`
                FROM `joke`
                INNER JOIN `author`
                ON `authorid` = `author`.`id`';
        $jokes = $pdo->query($sql);
        */

        // $jokes = alljokes($pdo);
        
        // 게시글 목록 보기
        $result = findAll($pdo, 'joke');

        $jokes = [];
        foreach ($result as $joke) {
            $author = findById($pdo, 'author', 'id', $joke['authorid']);

            $jokes[] = [
                'id' => $joke['id'],
                'joketext' => $joke['joketext'],
                'jokedate' => $joke['jokedate'],
                'name' => $author['name'],
                'email' => $author['email'],
                
            ];
        }
        
        $title = '유머 글 목록';

        //$totalJokes = totalJokes($pdo);
        $totalJokes = total($pdo, 'joke');

        ob_start();

        include __DIR__ . '/../templates/jokes.html.php';

        $output = ob_get_clean();


    } 
    catch (ExceptionType $e) {
        $title = '오류가 발생했습니다.';
        $output = '데이터베이스 오류:' .
                    $e->getMessage() . ', 위치: ' . $e->getFile() . ':' . $e->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';