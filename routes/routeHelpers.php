<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function redirect(string $url, string $params = null): void {
    if (is_null($params)) {
        header("Location: $url");
    } else {
        header("Location: $url/$params");
    }
    exit();
}