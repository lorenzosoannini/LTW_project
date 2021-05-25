<?php
    header("location: mailto:" . "lorenzosoannini@hotmail.it" . "?subject=" . $_POST['oggetto'] . "&body=" . $_POST['message']);
    echo    "<form id='myForm' action='index.html' method='get'>
                <input type='hidden' name='loginError' value='1'>
            </form>
            <script type='text/javascript'>
                document.getElementById('myForm').submit();
            </script>"; 
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
    
    </body>
</html>