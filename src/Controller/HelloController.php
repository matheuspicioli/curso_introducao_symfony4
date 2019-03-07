<?php

namespace App\Controller;

use App\Entity\Produto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
	/**
	 * @Route("hello_world")
	 */
	public function world()
	{
		return new Response(
			"<html><body><h1>HELLO WORLD!</h1></body></html>"
		);
	}

	/**
	 * @Route("mostrar-mensagem")
	 */
	public function mensagem()
	{
		return $this->render("hello/mensagem.html.twig");
	}

	/**
	 * @Route("cadastrar-produto")
	 */
	public function produto()
	{
		$em = $this->getDoctrine()->getManager();

		$produto = new Produto;
		$produto->setNome("Notebook")
			->setPreco(1800);

		$em->persist($produto);
		$em->flush();

		return new Response('O produto ' . $produto->getId() . ' foi criado');
	}
}