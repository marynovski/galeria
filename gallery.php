<?php
    session_start();
?>
<!Doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <nav id="nav">
        <a href="gallery.php" title="Galeria">
            <nav class="gallery-link">
                Galeria zdjęć
            </nav>
        </a>
    </nav>
    <main id="content">
        <section class="errors">
            <?php
                if (!empty($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
            ?>
        </section>
        <section class="success">
            <?php
                if (!empty($_SESSION['success'])) {
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                }
            ?>
        </section>

        <form action="addPhoto.php" enctype="multipart/form-data" method="post">
            <label for="author-name">Imię:</label>
            <input type="text" name="name" required>
            <br>
            <label for="author-name">Nazwisko:</label>
            <input type="text" name="surname" required>
            <br>
            <label for="author-name">Zdjęcie</label>
            <input type="file" name="photo" required>
            <br>
            <input type="submit" value="Dodaj zdjęcie">
        </form>
    </main>
</body>
</html>
