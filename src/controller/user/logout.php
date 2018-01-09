<?php

session_destroy();
session_start();
set_session_message("Your session has been closed successfully");
header('Location: /');
