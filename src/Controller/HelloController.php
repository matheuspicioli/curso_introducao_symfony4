<?php

namespace App\Controller;

use App\Entity\Produto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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

	/**
	 * @Route("formulario")
	 * @param Request $request
	 * @return Response
	 */
	public function formulario(Request $request)
	{
		$produto 	= new Produto;

		$form = $this->createFormBuilder($produto)
				->add('nome', TextType::class)
				->add('preco', TextType::class)
				->add('enviar', SubmitType::class, ['label' => 'Salvar'])
				->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			return new Response('Formulário válido');
		}

		return $this->render('hello/formulario.html.twig', [
			'form' => $form->createView()
		]);
	}
}