<?php
declare(strict_types=1);

require_once('bootstrap.php');

use App\Classes\EditorHistory;

/** @var EditorHistory $editorHistory */
$editorHistory = $GLOBALS['DI']->get(EditorHistory::class);

$editorHistory->saveText('Some Text 1');
$editorHistory->saveText('Some Text 2');
$editorHistory->saveText('Some Text 3');

echo $editorHistory->getCurrentVersion() . ' - ' . $editorHistory->getCurrentText() . PHP_EOL;

$editorHistory->restoreFromVersion(1);

echo $editorHistory->getCurrentVersion() . ' - ' . $editorHistory->getCurrentText() . PHP_EOL;

$editorHistory->restoreFromVersion(2);

echo $editorHistory->getCurrentVersion() . ' - ' . $editorHistory->getCurrentText() . PHP_EOL;

$editorHistory->restoreFromVersion(3);

echo $editorHistory->getCurrentVersion() . ' - ' . $editorHistory->getCurrentText() . PHP_EOL;

<<<'RESULT'
0 - Some Text 3
1 - Some Text 1
2 - Some Text 2
3 - Some Text 3
RESULT;
