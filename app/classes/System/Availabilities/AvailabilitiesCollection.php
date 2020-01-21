<?php namespace System\Availabilities;


class AvailabilitiesCollection
{
    /**
     * @var array
     */
    private $availability = [];

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->availability;
    }

    /**
     * @param array $reservation
     */
    public function add(array $reservation): void
    {
        $this->availability = $reservation;
    }

    public function getTotal(): int
    {
        return count($this->availability);
    }

}