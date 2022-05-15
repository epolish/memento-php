<?php
declare(strict_types=1);

namespace App\Classes;

use Exception;

class EditorHistory
{
    private EditorAbstract $editor;

    private int $currentVersion = 0;

    private array $editorSnapshots = [];

    public function __construct(EditorAbstract $editor)
    {
        $this->editor = $editor;
    }

    public function getCurrentText(): string
    {
        return $this->getEditor()->getText();
    }

    public function saveText(string $text)
    {
        $this->getEditor()->setText($text);

        $this->editorSnapshots[] = $this->getEditor()->save();
    }

    /**
     * @param int $version
     * @return void
     * @throws Exception
     */
    public function restoreFromVersion(int $version)
    {
        if ($version < 1 || $version > count($this->editorSnapshots)) {
            throw new Exception('Not valid version: ' . $version);
        }

        $this->getEditor()->restore($this->editorSnapshots[$version - 1]);

        $this->currentVersion = $version;
    }

    public function getCurrentVersion(): int
    {
        return $this->currentVersion;
    }

    public function getLastVersion(): int
    {
        return count($this->editorSnapshots);
    }

    private function getEditor(): EditorAbstract
    {
        return $this->editor;
    }
}
