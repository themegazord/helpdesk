<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function redirect($url): void {
    header("Location: $url");
    exit();
}