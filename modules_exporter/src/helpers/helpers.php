<?php

function getFileLineWithString(string $filePath, string $searchString): int{
    $lineNumber = 1;
    $fileLines = file($filePath);
    foreach($fileLines as $line){
        if(strpos($line, $searchString) !== false){
            return $lineNumber;
        }
        $lineNumber++;
    }
}

function deleteContentFromFile(string $filePath, string $searchString): string{
    $file = file($filePath);

    foreach( $file as $key=>$line ) {
      if( false !== strpos($line, $searchString) ) {
        unset($file[$key]);
      }
    }
    
    $file = implode("\n", $file);
    file_put_contents($filePath, $file);
    return $file;
}

function getFile(string $filePath, int $from = 0, ?int $to=null): string{
    $lines = file($filePath, FILE_IGNORE_NEW_LINES);
    if($to){
        $lines = array_slice($lines, $from, $to);
        $fileString = implode("\n", $lines);
        return $fileString;
    }
    return $lines;

}