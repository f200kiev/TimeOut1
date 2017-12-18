<?php

namespace AppBundle\Controller;

use AppBundle\Service\VenuesService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    private $venuesService;

    public function __construct(VenuesService $venuesService)
    {
        $this->venuesService = $venuesService;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $users = json_decode(file_get_contents(__DIR__ . '/../Fixtures/users.json'));
        $guests = [];
        if (!empty($users)) {
            foreach ($users as $user) {
                $guests[] = $user->name;
            }
        }

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'guests' => $guests
        ]);
    }

    /**
     * @Route("/venues", name="venue_list")
     * @Method("POST")
     */
    public function getVenuesList(Request $request): JsonResponse
    {
        $users = json_decode(file_get_contents(__DIR__ . '/../Fixtures/users.json'));
        $venues = json_decode(file_get_contents(__DIR__ . '/../Fixtures/venues.json'));

        $usersRequest = $request->get('guests');

        if (!empty($usersRequest)) {
            $users = array_filter($users, function ($user) use ($usersRequest) {
                if (in_array($user->name, $usersRequest)) {
                    return true;
                }
            });
        }
        $result = $this->venuesService->getVenuesList($users, $venues);

        return new JsonResponse($result);
    }
}
