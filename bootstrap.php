<?php
declare(strict_types=1);

require_once('vendor/autoload.php');

use App\Classes\{Editor, EditorAbstract};

$GLOBALS['DI'] = (new DI\ContainerBuilder())->addDefinitions([
    EditorAbstract::class => DI\create(Editor::class)
])->build();
