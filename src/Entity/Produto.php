<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
	 * @Assert\NotBlank()
	 */
    private $nome;

	/**
	 * @ORM\Column(type="decimal", scale=2)
	 * @Assert\NotBlank()
	 */
    private $preco;

	/**
	 * @ORM\Column(type="text")
	 * @Assert\NotBlank()
	 */
    private $descricao;

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

	/**
	 * @return mixed
	 */
	public function getDescricao()
	{
		return $this->descricao;
	}

	/**
	 * @param mixed $descricao
	 * @return Produto
	 */
	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;
		return $this;
	}

}
