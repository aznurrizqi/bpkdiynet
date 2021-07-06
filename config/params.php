<?php

// var_dump(Yii::getPathOfAlias('webroot')); die;
// $protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';

// $currentPath = explode("/", $_SERVER['PHP_SELF']);
// $baseUrl = $protocol  . '://' . $_SERVER['HTTP_HOST'] . '/' . $currentPath[1];

// $fileUrl = $baseUrl . '/app/web/uploads';
// $fileDir = '@app/web/uploads';

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer'
    // Yii::setAlias('fileUrl', $fileUrl),
    // Yii::setAlias('fileDir', $fileDir)
];
