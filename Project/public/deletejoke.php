<?php

    try{
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../classes/DatabaseTable.php';
        
        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');

        $jokesTable -> delete($_POST['id']);
        
        header('location: jokes.php');
    } catch (PDOExceptionType $e) {
        $title = '오류가 발생했습니다.';
        
        $output = '데이터베이스 오류:' .
                    $e->getMessage() . ', 위치: ' . $e->getFile() . ':' . $e->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';