<?php
echo "PHP WORKING. If you see this, PHP is working.";
echo "\nServer: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'unknown');
echo "\nDocument root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'unknown');
