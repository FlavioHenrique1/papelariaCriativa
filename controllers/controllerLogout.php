<?php
$session=new Classes\ClassSessions();
$session->destructSessions();
echo "<script>
    alert('Você efetuou o logout!');
    window.location.href='".DIRPAGE."';
</script>";
