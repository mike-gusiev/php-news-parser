<?php

class dbException extends Exception {
    public function errorMessage() {
        $errorMsg =
            "DataBase error!\nLine: " . $this->getLine() . "\nFile: " . $this->getFile() .
            "\n\nMessage:\n<b>" . $this->getMessage() . "</b>";
        return $errorMsg;
    }
}

function handleError($errno, $errstr, $errfile, $errline, array $errcontext)
{
    // молчим, если ошибку подавили оператором @
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

function databaseErrorHandler($message, $info)
{
    if (!error_reporting()) return;

    $result = Array(
        'status'   => false,
        'message'  => $info['message'],
        'phperror' => $message,
    );

    echo json_encode($result);
    exit();
}

?>