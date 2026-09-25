<?php

/**
 * @class poisson
 * @brief Represents a fish item in the inventory.
 *
 * This class stores all attributes related to a fish (poisson) and provides
 * accessors, HTML rendering helpers, and a method to export all values as an array.
 *
 * Fields:
 *   - idP   : unique identifier
 *   - nom   : fish name
 *   - dlc   : expiration date
 *   - prix  : price in euros
 *   - stock : quantity available
 *   - desc  : description
 *   - image : image filename or path
 *
 * @package FishIsAwesome
 */

class poisson {
    private $idP;
    private $nom;
    private $dlc;
    private $prix;
    private $stock;
    private $desc;
    private $image;


    /**
     * Constructs a poisson object with all required fields.
     *
     * @param int    $idP   Unique identifier.
     * @param string $nom   Fish name.
     * @param string $dlc   Expiration date.
     * @param float  $prix  Price in euros.
     * @param int    $stock Quantity available.
     * @param string $desc  Description text.
     * @param string $image Image filename or path.
     */
    public function __construct($idP, $nom, $dlc, $prix, $stock, $desc, $image){
        $this->idP = $idP;
        $this->nom = $nom;
        $this->dlc = $dlc;
        $this->prix = $prix;
        $this->stock = $stock;
        $this->desc = $desc;
        $this->image = $image;
    }
      
    
    /**
     * Returns the fish name.
     *
     * @return string
     */
    public function getNom(){
        return $this->nom;
    }
      
    /**
     * Returns the expiration date (DLC).
     *
     * @return string
     */
    public function getDlc(){
        return $this->dlc;
    }	
      
    
    /**
     * Returns the price in euros.
     *
     * @return float
     */
    public function getPrix(){
        return $this->prix;
    }
 
    
    /**
     * Returns the available stock quantity.
     *
     * @return int
     */
    public function getStock(){
        return $this->stock;
    }
    
    
    /**
     * Returns the description text.
     *
     * @return string
     */
    public function getDesc(){
        return $this->desc;
    }

    /**
     * Returns the image filename or path.
     *
     * @return string
     */       
    public function getImage(){
        return $this->image;
    }


    /**
     * Returns all fish attributes as an associative array.
     *
     * Keys:
     *   - nom
     *   - dlc
     *   - prix
     *   - stock
     *   - desc
     *   - image
     *
     * @return array Associative array of all stored values.
     */      
    public function getValeurs(){		
        $valeurs = array(
            "nom" => $this->nom,
            "dlc" => $this->dlc,
            "prix" => $this->prix,
            "stock" => $this->stock,
            "desc" => $this->desc,
            "image" => $this->image
        );
        return $valeurs;
    }
   
    
    /**
     * Returns an HTML <img> tag representing the fish image.
     *
     * @return string HTML markup for the image.
     */
    public function printImage(){
        return "<img src='". $this->image. "' alt='". $this->nom. "'>";
    }
    
    
    /**
     * Returns an HTML <li> element describing the fish and providing action links.
     *
     * Includes:
     *   - name
     *   - expiration date
     *   - stock quantity
     *   - links to: select, update, delete
     *
     * @return string HTML list item.
     */
    public function printLi(){
        return "<li>". $this->nom. " expires on ". $this->dlc. ", ". $this->stock. " units.
                <span>
                <a href='index.php?action=select&idP=". $this->idP. "'>See</a>
                <a href='index.php?action=update&idP=". $this->idP. "'>Modify</a>
                <a href='index.php?action=delete&idP=". $this->idP. "'>Delete</a>
                </span>
                </li>";
    }

    
    /**
     * Returns a full HTML section describing the fish.
     *
     * Includes:
     *   - name (h2)
     *   - table with expiration date, price, stock, description
     *   - image
     *
     * @return string HTML representation of the poisson object.
     */
    public function __toString(){
        $res = "<section>";
        $res .= "<h2>". $this->nom. "</h2>";
        $res .= "<table><tr>";
            $res .= "<td>";
                $res .= "<h4>". $this->dlc. ", ". $this->prix. "€, ". $this->stock. " unités</h4>";
                $res .= "<p>". $this->desc. "</p>";
            $res .= "</td>";
            $res .= "<td><img src='". $this->image. "' alt='". $this->nom. "'></td>";
        $res .= "</tr></table></section>";
        return $res;
    }
}
?>