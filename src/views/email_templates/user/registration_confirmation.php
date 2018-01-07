<?php
return "Hello $first_name,<br><br>
Thanks for register at 506.com, please click on the following link in order to activate your account.<br><br>
- <a href='http://{$_SERVER['SERVER_NAME']}/user/activate?key={$key}'>http://{$_SERVER['SERVER_NAME']}/user/activate?key={$key}</a>";