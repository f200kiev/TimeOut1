<?php

namespace AppBundle\Service;

class VenuesService
{
    public function getVenuesList(array $guests, array $venues)
    {
        $apply = [];
        $decline = [];

        if (!empty($venues)) {
            foreach ($venues as $venue) {
                $applyVenue = true;
                $venueStatus = array_filter(array_map(function ($guest) use ($venue, &$applyVenue) {
                    if (empty(array_uintersect($guest->drinks, $venue->drinks, 'strcasecmp'))) {
                        $applyVenue = false;
                        $message[] = "There is nothing for $guest->name to drink";
                    }
                    if (empty(array_udiff($venue->food, $guest->wont_eat, 'strcasecmp'))) {
                        $applyVenue = false;
                        $message[] = "There is nothing for $guest->name to eat";
                    }

                    return $message ?? [];
                }, $guests), function ($response) {
                    if (!empty($response)) {
                        return true;
                    }
                });

                if (true === $applyVenue) {
                    $apply[$venue->name] = [];
                } else {
                    $decline[$venue->name] = array_values($venueStatus);
                }
            }
        }

        return [$apply, $decline];
    }
}
