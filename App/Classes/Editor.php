<?php
declare(strict_types=1);

namespace App\Classes;

use stdClass;

final class Editor extends EditorAbstract
{
    public function save(): stdClass
    {
        return $this->createSnapshot($this->serialize());
    }

    public function restore(stdClass $snapshot)
    {
        $data = $this->unserialize($snapshot);

        $this->setText($data['text']);
    }

    private function serialize(): string
    {
        return serialize(['text' => $this->getText()]);
    }

    private function unserialize(stdClass $snapshot): array
    {
        if (get_class($snapshot) !== get_class($this->createSnapshot(''))) {
            trigger_error(
                "Class '" . get_class($snapshot) . "' is not the proper anonymous", E_USER_ERROR
            );
        }

        return unserialize($snapshot->getSnapshot());
    }

    /**
     * That's how we hide the interface, via fake inheritance from stdClass
     */
    private function createSnapshot(string $snapshot)
    {
        return new class ($snapshot) extends stdClass {
            private string $snapshot;

            public function __construct(string $snapshot)
            {
                $this->snapshot = $snapshot;
            }

            public function getSnapshot(): string
            {
                return $this->snapshot;
            }
        };
    }
}
