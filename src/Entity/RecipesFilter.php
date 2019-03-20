<?php 

namespace App\Entity;

class RecipesFilter
{
    /**
     * @var integer|null
     */
    private $style;
    
    /**
     * @var string|null
     */
    private $method;

    /**
     * @var string|null
     */
    private $difficulty;

    /**
     * Get the value of style
     *
     * @return  integer|null
     */ 
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set the value of style
     *
     * @param  integer|null  $style
     *
     * @return  self
     */ 
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get the value of method
     *
     * @return  string|null
     */ 
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the value of method
     *
     * @param  string|null  $method
     *
     * @return  self
     */ 
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get the value of difficulty
     *
     * @return  string|null
     */ 
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set the value of difficulty
     *
     * @param  string|null  $difficulty
     *
     * @return  self
     */ 
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }
}

