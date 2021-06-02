<?php

namespace App\Controller;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;  

class ItemController extends AbstractController
{
   /**
     * @Route("/items/", name="add_item", methods={"POST"})
     */
    public function add(Request $request,EntityManagerInterface $em): Response
    {
        $data = json_decode($request->getContent());
     	$item = new Item();
    	// hydrater
    	$item->setTitle($data->title);
    	$item->setStatus(false);
        $em->persist($item);
        $em->flush();
    	$tab["id"] = $item->getId();
        return $this->json($tab);
    }

       /**
     * @Route("/items/{id}", name="edit_item", methods={"PUT"})
     */
    public function edit(Item $item,EntityManagerInterface $em): Response
    {
        if ($item->getStatus())
        {
            $item->setStatus(false);
        }
        else{
             $item->setStatus(true);
        }
        $em->persist($item);
        $em->flush();
        $tab["info"] = "ok";
        return $this->json($tab);
    }

     /**
     * @Route("/items/{id}",name="delete_item", methods={"DELETE"})
     */
    public function remove(Item $item,EntityManagerInterface $em): Response
    {
        $em->remove($item);
        $em->flush();
    	$tab["delete"] = "ok";
        return $this->json($tab);
    }

    /**
     * @Route("/items/", name="list_item", methods={"GET"})
     */
    public function all(ItemRepository $repo): Response
    {
        return $this->json($repo->findAll());
    }
}
