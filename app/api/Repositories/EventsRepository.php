<?php

namespace SlimJIM\Repositories;

use \Illuminate\Database\Capsule\Manager;

class EventsRepository
{
    // Private Variables
    private $database;

    // Constructor
    public function __construct(Manager $manager)
    {
        $this->database = $manager;
    }

    // GET Events List: All
    public function getAll()
    {
        return $this->database->table('events')->get();
    }

    // GET Events List: Overdue
    public function getOverdue()
    {
        return $this->database
            ->table('events')
            ->whereRaw('start < CURDATE()')
            ->get();
    }

    // GET Events List: Today
    public function getToday()
    {
        return $this->database
            ->table('events')
            ->whereRaw('start >= CURDATE() AND start < CURDATE() + 1')
            ->get();
    }

    // GET Events List: Upcoming
    public function getUpcoming()
    {
        return $this->database
            ->table('events')
            ->whereRaw('start > CURDATE()')
            ->get();
    }

    // CREATE Events
    public function create(array $event): bool
    {
        $event = $this->validateEvent($event);

        return $this->database
            ->table('events')
            ->insert($event);
    }

    // UPDATE Events by ID
    public function update(string $id, array $event): bool
    {
        $event = $this->validateEvent($event);

        return $this->database
            ->table('events')
            ->where('id', $id)
            ->update($event);
    }

    // DELETE Events by ID
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