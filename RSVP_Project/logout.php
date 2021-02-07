<?php

// Destroy
session_unset();
session_destroy();
header('Location: index.html');
