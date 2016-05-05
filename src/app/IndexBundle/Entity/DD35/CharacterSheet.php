<?php
namespace app\IndexBundle\Entity\DD35;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="CharacterSheet", schema="reglasf")
 */

class CharacterSheet
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="CharacterSheetData", mappedBy="CharacterSheet")
     */
    private $character_sheet_data;
    /**
     * @ORM\Column(type="string", length=30)
     */
    private $character_sheet_template;
    /**
     * @ORM\Column(type="string", length=30)
     */
    private $user;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->character_sheet_data = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set name
     *
     * @param string $name
     * @return CharacterSheet
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
     * Add character_sheet_data
     *
     * @param \app\IndexBundle\Entity\CharacterSheetData $characterSheetData
     * @return CharacterSheet
     */
    public function addCharacterSheetDatum(\app\IndexBundle\Entity\CharacterSheetData $characterSheetData)
    {
        $this->character_sheet_data[] = $characterSheetData;
        return $this;
    }
    /**
     * Remove character_sheet_data
     *
     * @param \app\IndexBundle\Entity\CharacterSheetData $characterSheetData
     */
    public function removeCharacterSheetDatum(\app\IndexBundle\Entity\CharacterSheetData $characterSheetData)
    {
        $this->character_sheet_data->removeElement($characterSheetData);
    }
    /**
     * Get character_sheet_data
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCharacterSheetData()
    {
        return $this->character_sheet_data;
    }
    /**
     * Set character_sheet_template
     *
     * @param \app\IndexBundle\Entity\CharacterSheetTemplate $characterSheetTemplate
     * @return CharacterSheet
     */
    public function setCharacterSheetTemplate(\app\IndexBundle\Entity\CharacterSheetTemplate $characterSheetTemplate = null)
    {
        $this->character_sheet_template = $characterSheetTemplate;
        return $this;
    }
    /**
     * Get character_sheet_template
     *
     * @return \app\IndexBundle\Entity\CharacterSheetTemplate 
     */
    public function getCharacterSheetTemplate()
    {
        return $this->character_sheet_template;
    }
    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return CharacterSheet
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }
    /**
     * Get user
     *
     * @return \UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}