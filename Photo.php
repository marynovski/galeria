<?php
session_start();

class Photo
{
    private $mimeType;
    private $tmpName;
    private $name;
    private $error;
    private $size;
    private $extenstion;
    private $localization;

    public function __construct($mimeType, $tmpName, $error, $size)
    {
        $this->mimeType = $mimeType;
        $this->tmpName = $tmpName;
        $this->error = $error;
        $this->size = $size;
    }

    /**
     * Check errors
     *
     * @return bool
     */
    private function checkErrors()
    {
        if ($this->error > 0) {
            echo 'problem: ';
            switch ($this->error) {
                case 1:
                    $_SESSION['error'] = 'Rozmiar pliku jest zbyt duży.';
                    break;
                case 2:
                    $_SESSION['error'] = 'Rozmiar pliku jest zbyt duży.';
                    break;
                case 3:
                    $_SESSION['error'] = 'Plik wysłany tylko częściowo.';
                    break;
                case 4:
                    $_SESSION['error'] = 'Nie wysłano żadnego pliku.';
                    break;
                default:
                    $_SESSION['error'] = 'Wystąpił błąd podczas wysyłania.';
                    break;
            }
            return false;
        }
        return true;
    }

    /**
     * Check if file is image
     *
     * @return bool
     */
    private function checkType()
    {
        if ($this->mimeType == 'image/jpeg') {
            $this->extenstion = '.jpg';
            return true;
        }
        if ($this->mimeType == 'image/png') {
            $this->extenstion = '.png';
            return true;
        }
        $_SESSION['error'] = 'Plik nie jest zdjeciem jpg/png!';
        return false;
    }


    /**
     * Saving image to the photos directory
     *
     * @return bool
     */
    public function save($fileName, $id)
    {
        if (!$this->checkErrors()) {
            header('Location: gallery.php');
            return false;
        }

        if (!$this->checkType()) {
            header('Location: gallery.php');
            return false;
        }

        $this->localization = 'photos/' . $fileName . '_' . $id . '_0_0' . $this->extenstion;

        if (is_uploaded_file($this->tmpName)) {
            if (!move_uploaded_file($this->tmpName, $this->localization)) {
                $_SESSION['error'] = 'problem: Nie udało się skopiować pliku do katalogu.';
                return false;
            }
        } else {
            $_SESSION['error'] = 'Plik nie został zapisany.';
            return false;
        }
        $_SESSION['success'] = 'Pomyślnie dodano zdjęcie!';
        return true;
    }

}