<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>First Oracle DB Demo</title>
    </head>
    <body>
        <?php
        $db = '(DESCRIPTION =
                (ADDRESS = (PROTOCOL = TCP)(HOST = Nadeera)(PORT = 8090))
                (CONNECT_DATA =
                (SERVER = DEDICATED)
                (SID = XE)))';

//        $conn = oci_new_connect('system', 'system', $db);
//		$conn = oci_connect('system', 'system', $db);
//        $conn = oci_connect('hr', 'hr', 'localhost:8080/XE');
//        $conn = oci_connect('system', 'system', 'Nadeera:8090/XE');
        $conn = OCILogon('system', 'system', $db);
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        } else {
            echo 'Connected successfully';
        }
        ?>
    </body>
</html>
