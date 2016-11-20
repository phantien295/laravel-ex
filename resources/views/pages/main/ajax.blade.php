<?php

	$book = App\Book::all()->toArray();
    $books = array();
    foreach ($book as $key) {
        $books[] = $key;
    }
    $jTableResult = array();
    $jTableResult['Result'] = "OK";
    $jTableResult['TotalRecordCount'] = App\Book::all()->count();
    $jTableResult['Records'] = $books;
    print json_encode($jTableResult);

    ?>