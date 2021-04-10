<?php

namespace SlimJIM\Repositories;

use \Illuminate\Database\Capsule\Manager;

class EventsRepository
{
    private $database;

    public function __construct(Manager $manager)
    {
        $this->database = $manager;
    }

    public function getAll()
    {
        return $this->database->table('events')->get();
    }

    public function getUpcoming()
    {
        return $this->database
            ->table('events')
            ->where('start_event', '>', '2021-04-10')
            ->get();
    }

    public function create(array $event): bool
    {
        $event = $this->validateEvent($event);

        return $this->database
            ->table('events')
            ->insert($event);
    }

    public function update(string $id, array $event): bool
    {
        $event = $this->validateEvent($event);

        return $this->database
            ->table('events')
            ->where('id', $id)
            ->update($event);
    }

    public function delete(string $id): bool
    {
        return $this->database
            ->table('events')
            ->where('id', $id)
            ->delete();
    }

    private function validateEvent(array $event): array
    {
        return [
            'title' => $event['title'],
            'start' => $event['start'],
            'end' => $event['end'],
        ];
    }
}