<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
 */
class Company
{
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Market", inversedBy="companies")
     * @ORM\JoinTable(name="companies_markets")
     */
     private $markets;


    /**
     * @ORM\ManyToMany(targetEntity="Stock", mappedBy="companies")
     */
    private $stocks;

    public function __construct() {
        $this->markets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stocks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add market
     *
     * @param \AppBundle\Entity\Market $market
     *
     * @return Company
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

    /**
     * Add stock
     *
     * @param \AppBundle\Entity\Stock $stock
     *
     * @return Company
     */
    public function addStock(\AppBundle\Entity\Stock $stock)
    {
        $this->stocks[] = $stock;

        return $this;
    }

    /**
     * Remove stock
     *
     * @param \AppBundle\Entity\Stock $stock
     */
    public function removeStock(\AppBundle\Entity\Stock $stock)
    {
        $this->stocks->removeElement($stock);
    }

    /**
     * Get stocks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStocks()
    {
        return $this->stocks;
    }
}
