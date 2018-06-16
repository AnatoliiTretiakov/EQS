<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stock
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StockRepository")
 */
class Stock
{
    public const COMMON = 'Common';
    public const PREFERRED = 'Preferred';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

     /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
     private $type;
     

     /**
     * @ORM\ManyToMany(targetEntity="Company", inversedBy="stocks")
     * @ORM\JoinTable(name="stocks_companies")
     */
     private $companies;


    /**
     * @ORM\ManyToMany(targetEntity="Market", inversedBy="stocks")
     * @ORM\JoinTable(name="stocks_markets")
     */
     private $markets;

     public function __construct() {
        $this->companies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Stock
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Stock
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add company
     *
     * @param \AppBundle\Entity\Company $company
     *
     * @return Stock
     */
    public function addCompany(\AppBundle\Entity\Company $company)
    {
        $this->companies[] = $company;

        return $this;
    }

    /**
     * Remove company
     *
     * @param \AppBundle\Entity\Company $company
     */
    public function removeCompany(\AppBundle\Entity\Company $company)
    {
        $this->companies->removeElement($company);
    }

    /**
     * Get companies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    public function __toString() {
        return $this->type;
    }

    /**
     * Add market
     *
     * @param \AppBundle\Entity\Market $market
     *
     * @return Stock
     */
    public function addMarket(\AppBundle\Entity\Market $market)
    {
        $this->markets[] = $market;

        return $this;
    }

    /**
     * Remove market
     *
     * @param \AppBundle\Entity\Market $market
     */
    public function removeMarket(\AppBundle\Entity\Market $market)
    {
        $this->markets->removeElement($market);
    }

    /**
     * Get markets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMarkets()
    {
        return $this->markets;
    }
}
