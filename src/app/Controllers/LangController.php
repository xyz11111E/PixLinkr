<?php

namespace App\Controllers;

class LangController
{
    public function setLang()
    {
        $lang = $_GET["lang"];

        if (in_array($lang, ["en", "ro", "ru"]))
        {
            $_SESSION["lang"] = $lang;
        }

        header("Location: " . ($_SERVER["HTTP_REFERER"] ?? "/"));
        exit;
    }
}