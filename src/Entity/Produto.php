<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProdutoRepository")
 */
class Produto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

	/**
	 * @ORM\Column(type="string", length=100)
	 */
    private $nome;

	/**
	 * @ORM\Column(type="decimal", scale=2)
	 */
    private $preco;

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 * @return Produto
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getNome()
	{
		return $this->nome;
	}

	/**
	 * @param mixed $nome
	 * @return Produto
	 */
	public function setNome($nome)
	{
		$this->nome = $nome;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPreco()
	{
		return $this->preco;
	}

	/**
	 * @param mixed $preco
	 * @return Produto
	 */
	public function setPreco($preco)
	{
		$this->preco = $preco;
		return $this;
	}
}