<?php
// https://github.com/tsugiproject/honor
require_once "../config.php";

use \Tsugi\Util\U;
use \Tsugi\Util\LTI13;
use \Tsugi\Core\LTIX;
use \Tsugi\UI\Output;

// Handle all forms of launch
$LTI = LTIX::requireData();

$grade = U::get($_POST, 'grade');
$comment = U::get($_POST, 'comment');

if ( count($_POST) > 0 && is_string($grade) ) {
   $debug_log = array();
   $LTI->result->gradeSend($grade, false, $debug_log, $extra);
   $lastSendTransport = $LTI->result->lastSendTransport;
   $_SESSION['transport'] = $lastSendTransport;
   $_SESSION['debug_log'] = $debug_log;
   header("Location: ".addSession("index.php"));
   return;
}

$lastSendTransport = U::get($_SESSION, 'transport');
$debug_log = U::get($_SESSION, 'debug_log');

// Render view
$OUTPUT->header();
$OUTPUT->bodyStart();
$OUTPUT->topNav();

$OUTPUT->welcomeUserCourse();

$OUTPUT->footerStart();
?>
<script>
</script>
<?php

$OUTPUT->footerEnd();
