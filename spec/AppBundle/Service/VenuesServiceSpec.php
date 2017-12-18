<?php

namespace spec\AppBundle\Service;

use AppBundle\Service\VenuesService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VenuesServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(VenuesService::class);
    }

    public function it_should_show_no_venues_to_eat_and_drink()
    {
        $guest1 = new \stdClass();
        $guest1->name = 'Guest 1';
        $guest1->wont_eat = ['Fish', 'Pasta'];
        $guest1->drinks = ['Tequila'];

        $guest2 = new \stdClass();
        $guest2->name = 'Guest 2';
        $guest2->wont_eat = ['Fish', 'Mexican'];
        $guest2->drinks = ['Beer'];

        $guests = [$guest1, $guest2];

        $venues = $this->getVenues();

        $this->getVenuesList($guests, $venues)->shouldReturn(
            [
                [],
                ['El Cantina' => [
                    [
                        'There is nothing for Guest 1 to eat',
                    ],
                ], 'Twin Dynasty' => [
                    [
                        'There is nothing for Guest 1 to drink',
                    ],
                    [
                        'There is nothing for Guest 2 to eat',
                    ],
                ], 'Wagamama' => [
                    [
                        'There is nothing for Guest 1 to drink',
                    ],
                ]],
            ]
        );
    }

    public function it_should_show_the_list_of_venues_to_eat_and_drink()
    {
        $guest1 = new \stdClass();
        $guest1->name = 'Guest 1';
        $guest1->wont_eat = ['Fish'];
        $guest1->drinks = ['Tequila', 'Wodka'];

        $guest2 = new \stdClass();
        $guest2->name = 'Guest 2';
        $guest2->wont_eat = ['Fish'];
        $guest2->drinks = ['Beer'];

        $guests = [$guest1, $guest2];

        $venues = $this->getVenues();

        $this->getVenuesList($guests, $venues)->shouldReturn(
            [
                ['El Cantina' => [], 'Twin Dynasty' => [], 'Wagamama' => []],
                [],
            ]
        );
    }

    public function it_should_show_the_list_of_venues_where_no_drink_for_one_of_the_guests()
    {
        $guest1 = new \stdClass();
        $guest1->name = 'Guest 1';
        $guest1->wont_eat = ['Fish'];
        $guest1->drinks = ['Tea'];

        $guest2 = new \stdClass();
        $guest2->name = 'Guest 2';
        $guest2->wont_eat = ['Fish'];
        $guest2->drinks = ['Beer'];

        $guests = [$guest1, $guest2];

        $venues = $this->getVenues();

        $this->getVenuesList($guests, $venues)->shouldReturn(
            [
                [],
                ['El Cantina' => [
                    [
                        'There is nothing for Guest 1 to drink',
                    ],
                ], 'Twin Dynasty' => [
                    [
                        'There is nothing for Guest 1 to drink',
                    ],
                ], 'Wagamama' => [
                    [
                        'There is nothing for Guest 1 to drink',
                    ],
                ]],
            ]
        );
    }

    public function it_should_show_the_list_of_venues_where_no_food_for_one_of_the_guests()
    {
        $guest1 = new \stdClass();
        $guest1->name = 'Guest 1';
        $guest1->wont_eat = ['Pasta'];
        $guest1->drinks = ['Soft Drinks'];

        $guest2 = new \stdClass();
        $guest2->name = 'Guest 2';
        $guest2->wont_eat = ['Fish'];
        $guest2->drinks = ['Beer'];

        $guests = [$guest1, $guest2];

        $venues = $this->getVenues();

        $this->getVenuesList($guests, $venues)->shouldReturn(
            [
                ['Twin Dynasty' => [], 'Wagamama' => []],
                ['El Cantina' => [
                    [
                        'There is nothing for Guest 1 to eat',
                    ],
                ]],
            ]
        );
    }

    public function it_should_show_the_list_of_venues_not_to_go_with_three_guests()
    {
        $guest1 = new \stdClass();
        $guest1->name = 'Guest 1';
        $guest1->wont_eat = ['Pasta'];
        $guest1->drinks = ['Whisky'];

        $guest2 = new \stdClass();
        $guest2->name = 'Guest 2';
        $guest2->wont_eat = ['Fish'];
        $guest2->drinks = ['Beer'];

        $guest3 = new \stdClass();
        $guest3->name = 'Guest 3';
        $guest3->wont_eat = ['Mexican', 'Fish'];
        $guest3->drinks = ['Beer'];

        $guests = [$guest1, $guest2, $guest3];

        $venues = $this->getVenues();

        $this->getVenuesList($guests, $venues)->shouldReturn(
            [
                [],
                ['El Cantina' => [
                    [
                        'There is nothing for Guest 1 to drink',
                        'There is nothing for Guest 1 to eat',
                    ],
                ], 'Twin Dynasty' => [
                    [
                        'There is nothing for Guest 3 to eat',
                    ],
                ], 'Wagamama' => [
                    [
                        'There is nothing for Guest 1 to drink',
                    ],
                ]],
            ]
        );
    }

    public function getVenues()
    {
        $venue1 = new \stdClass();
        $venue1->name = 'El Cantina';
        $venue1->food = ['Pasta'];
        $venue1->drinks = ['Soft Drinks', 'Tequila', 'Beer'];

        $venue2 = new \stdClass();
        $venue2->name = 'Twin Dynasty';
        $venue2->food = ['Fish', 'Mexican'];
        $venue2->drinks = ['Soft Drinks', 'Rum', 'Beer', 'Whisky', 'Cider', 'Wodka'];

        $venue3 = new \stdClass();
        $venue3->name = 'Wagamama';
        $venue3->food = ['Japanese'];
        $venue3->drinks = ['Beer', 'Cider', 'Soft Drinks', 'Sake', 'Wodka'];

        return [$venue1, $venue2, $venue3];
    }
}
