<!DOCTYPE html>
<html lang="pl" class="no-js">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta content="noodp" name="robots" />
        <meta content="noydir" name="robots" />
        <title>Vlepy.pl - druk vlepek w 24h</title>
        <meta name="description" content="Producent vlepek. Druk i wysyłka w 24h. Szybkie i wygodne zamawianie vlepek. Drukujemy wlpeki w różnych wymiarach." />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <?php include 'app/views/shared/_google_tag_manager.php' ?>
        <?php include 'app/views/shared/_google_analytics.php' ?>

        <!-- CSS -->
        <?= ApplicationHelper::minifyCss() ?>

        <!-- JS -->
        <?= ApplicationHelper::minifyJs() ?>

    </head>
    <body data-env="<?= Config::get('env') ?>">
        <?php include 'app/views/shared/_google_tag_manager_noscript.php' ?>
        <?php include 'app/views/shared/_header.php'; ?>
        <div id="content">
            <?php include ($path) ? $path : 'app/views/shared/404.php' ?>
        </div>
        <?php include 'app/views/shared/_footer.php'; ?>
    </body>
</html>
