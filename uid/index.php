<?php
$currentUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (preg_match('/\/uid\/(\d+)/', $currentUrl, $matches)) {
    $uid = $matches[1]; 
}
?>
<script>window.location.href = `${window.location.origin}/account/?id=<?php echo $uid ?>`;</script>