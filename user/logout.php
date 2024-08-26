<?php
if (session_start()) {
    session_destroy();
    header("Location:../");
}
header("Location:../");
