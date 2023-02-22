<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    private $sales;

    public function __construct()
    {
        $this->sales = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSales()
    {
        return $this->sales;
    }

    public function setSales($sales)
    {
       
        $salesTotal = 0;
        $total = 0;
        foreach($sales as $sale){
            $salesTotal++;
            $total = $total + $sale->getAmount();
        }
        $this->sales = $salesTotal." - $".$total;
        return $this->sales;
    }

    
}
