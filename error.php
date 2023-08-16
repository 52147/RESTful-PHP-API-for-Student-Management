<!DOCTYPE html>
<html>

<!-- the head section -->

<head>
    <title>My Course Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->

<body>
    <header>
        <h1>Course Manager</h1>
    </header>

    <main>
        <h2 class="top">Error</h2>
        <p><?php
            if (isset($error)) {
                echo $error;
            } else {
                echo "An unspecified error occurred.";
            }
            ?></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Suresh Kalathur</p>
    </footer>
</body>

</html>