<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProdutoController extends AbstractController
{
    /**
     * @Route("/produto", name="listar_produto")
	 * @Template("produto/index.html.twig")
     */
    public function index()
    {
    	$entityManager = $this->getDoctrine()->getManager();

    	$produtos = $entityManager->getRepository(Produto::class)
						->findAll();

        return [
        	'produtos' => $produtos
		];
    }

	/**
	 * @param Request $request
	 *
	 * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
	 *
	 * @Route("/produto/cadastrar", name="cadastrar_produto")
	 * @Template("produto/create.html.twig")
	 */
	public function create(Request $request)
	{
		$produto = new Produto;

		$form = $this->createForm(ProdutoType::class, $produto);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();

			$entityManager->persist($produto);
			$entityManager->flush();

//			$this->get('session')->getFlashBag()->set('sucesso', 'Produto cadastrado com sucesso!');
			$this->addFlash('sucesso', 'Produto cadastrado com sucesso!');
			return $this->redirectToRoute('listar_produto');
		}

		return [
			'form' => $form->createView()
		];
    }

	/**
	 * @param Request $request
	 * @param         $id
	 *
	 * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
	 *
	 * @Route("produto/editar/{id}", name="editar_produto")
	 * @Template("produto/update.html.twig")
	 */
	public function update(Request $request, $id)
	{
		$entityManager = $this->getDoctrine()->getManager();
		$produto = $entityManager->getRepository(Produto::class)
			->find($id);

		if ($produto == null) {
			// TODO: redirecionar
		}

		$form = $this->createForm(ProdutoType::class, $produto);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager->persist($produto);
			$entityManager->flush();

//			$this->get('session')->getFlashBag()->set('sucesso', 'Produto '. $produto->getNome() .' alterado com sucesso!');
			$this->addFlash('sucesso', 'Produto '. $produto->getNome() .' alterado com sucesso!');
			return $this->redirectToRoute('listar_produto');
		}

		return [
			'produto' 	=> $produto,
			'form'		=> $form->createView()
		];
    }

	/**
	 * @param Request $request
	 * @param         $id
	 *
	 * @return array
	 *
	 * @Route("produto/visualizar/{id}", name="visualizar_produto")
	 * @Template("produto/view.html.twig")
	 */
	public function view(Request $request, $id)
	{
		$entityManager = $this->getDoctrine()->getManager();
		$produto = $entityManager->getRepository(Produto::class)
			->find($id);

		return [
			'produto' => $produto
		];
    }

	/**
	 * @param Request $request
	 * @param         $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 *
	 * @Route("produto/deletar/{id}", name="apagar_produto")
	 */
	public function delete(Request $request, $id)
	{
		$entityManager = $this->getDoctrine()->getManager();
		$produto = $entityManager->getRepository(Produto::class)->find($id);

		if ($produto == null) {
			$mensagem 	= "Produto não encontrado!";
			$tipo 		= 'warning';
		} else {
			$entityManager->remove($produto);
			$entityManager->flush();

			$mensagem = "Produto excluído com sucesso!";
			$tipo = 'sucesso';
		}

//		$this->get('session')->getFlashBag()->set($tipo, $mensagem);
		$this->addFlash($tipo, $mensagem);
		return $this->redirectToRoute('listar_produto');
    }
}
