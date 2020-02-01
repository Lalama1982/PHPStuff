<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Try Catch Exception Example</title>
    </head>
    <body>
        <?php
        try {
            $error = 'Always throw this error';
            throw new Exception($error);

            // Code following an exception is not executed.
            echo 'Never executed';
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        // Continue execution
//        echo '<br /> Hello World';
        ?>
    </body>
</html>
