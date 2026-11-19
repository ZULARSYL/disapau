<?php

class Flasher
{
    public static function setFlash($pesan, $aksi, $tipe, $text)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe,
            'text' => $text,
        ];
    }

    public static function flash()
    {

        if (isset($_SESSION['flash'])) {
            echo '
            <div class="p-4 mb-4 text-sm text-' . $_SESSION['flash']['text'] . ' rounded-lg ' . $_SESSION['flash']['tipe'] . ' dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">' . $_SESSION['flash']['pesan'] . ' </span>' . $_SESSION['flash']['aksi'] . '
            </div>';
            unset($_SESSION['flash']);
        }
    }
}