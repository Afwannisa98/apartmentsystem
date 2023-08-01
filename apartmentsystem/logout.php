<?php
// Perform any logout actions here, such as clearing session data, cookies, etc.
// For example, you can use session_destroy() to clear the session data.

// Redirect the user back to the login page after logout
header("Location: index.php");
exit();
?>
