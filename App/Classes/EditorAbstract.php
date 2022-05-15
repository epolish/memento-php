<?php
declare(strict_types=1);

namespace App\Classes;

use stdClass;

/**
 * Memento's business logic is here
 */
abstract class EditorAbstract
{
    protected string $text;

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    abstract public function save(): stdClass;

    abstract public function restore(stdClass $snapshot);
}
