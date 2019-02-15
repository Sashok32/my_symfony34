<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;

//use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="product_list")
     * @Template()
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();

       return ['products' => $products];
    }

    /**
     * @Route("/products/{id}", name="product_item", requirements={"id": "[0-9]+"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id) // or parameter Request $request
    {
        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($id);

        if(!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        return $this->render('@App/product/show.html.twig', ['product' => $product]);
    }
}