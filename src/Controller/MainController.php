<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Entiry\Category;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(CategoryRepository $repository): Response
    {
        $results = [];

        $categories = $repository->findAll();

        foreach ($categories as $category) {
            $goods = $category->getGoods();
            foreach ($goods as $good) {
                $results []= [
                    'category' => $category->getName(),
                    'good' => $good->getName(),
                    'count' => $good->getCount(),
                    'price' => $good->getPrice(),
                ];
            }
        }

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'results' => $results,
        ]);
    }
}
