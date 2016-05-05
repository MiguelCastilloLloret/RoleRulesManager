<?php
namespace app\IndexBundle\Entity\DD35;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="CharacterSheetData", schema="reglasf")
 */

class CharacterSheetData
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
     * @ORM\Column(type="string", length=30)
     */
    private $datatype;
     /**
     * @ORM\Column(type="string", length=30)
     */
    private $display_name;
     /**
     * @ORM\Column(type="json_array", length=50)
     */
    private $value;
    /**
     * @ORM\OneToMany(targetEntity="CharacterSheetData", mappedBy="character_sheet_data_group")
     */
    private $character_sheet_data;
    /**
     * @ORM\ManyToOne(targetEntity="CharacterSheet", inversedBy="character_sheet_data")
     * @ORM\JoinColumn(name="character_sheet_id", referencedColumnName="id")
     */
    private $character_sheet;
    /**
     * @ORM\ManyToOne(targetEntity="CharacterSheetData", inversedBy="character_sheet_data")
     * @ORM\JoinColumn(name="character_sheet_data_group_id", referencedColumnName="id")
     */
    private $character_sheet_data_group;
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
     * @return CharacterSheetData
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
     * Set datatype
     *
     * @param string $datatype
     * @return CharacterSheetData
     */
    public function setDatatype($datatype)
    {
        $this->datatype = $datatype;
        return $this;
    }
    /**
     * Get datatype
     *
     * @return string 
     */
    public function getDatatype()
    {
        return $this->datatype;
    }
    /**
     * Set display_name
     *
     * @param string $displayName
     * @return CharacterSheetData
     */
    public function setDisplayName($displayName)
    {
        $this->display_name = $displayName;
        return $this;
    }
    /**
     * Get display_name
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }
    /**
     * Set value
     *
     * @param array $value
     * @return CharacterSheetData
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
    /**
     * Get value
     *
     * @return array 
     */
    public function getValue()
    {
        return $this->value;
    }
    /**
     * Add character_sheet_data
     *
     * @param \app\IndexBundle\Entity\CharacterSheetData $characterSheetData
     * @return CharacterSheetData
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
     * Set character_sheet
     *
     * @param \app\IndexBundle\Entity\CharacterSheet $characterSheet
     * @return CharacterSheetData
     */
    public function setCharacterSheet(\app\IndexBundle\Entity\CharacterSheet $characterSheet = null)
    {
        $this->character_sheet = $characterSheet;
        return $this;
    }
    /**
     * Get character_sheet
     *
     * @return \app\IndexBundle\Entity\CharacterSheet 
     */
    public function getCharacterSheet()
    {
        return $this->character_sheet;
    }
    /**
     * Set character_sheet_data_group
     *
     * @param \app\IndexBundle\Entity\CharacterSheetData $characterSheetDataGroup
     * @return CharacterSheetData
     */
    public function setCharacterSheetDataGroup(\app\IndexBundle\Entity\CharacterSheetData $characterSheetDataGroup = null)
    {
        $this->character_sheet_data_group = $characterSheetDataGroup;
        return $this;
    }
    /**
     * Get character_sheet_data_group
     *
     * @return \app\IndexBundle\Entity\CharacterSheetData 
     */
    public function getCharacterSheetDataGroup()
    {
        return $this->character_sheet_data_group;
    }
}