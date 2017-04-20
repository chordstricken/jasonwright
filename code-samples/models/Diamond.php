<?php
namespace models;

/**
 * This class represents a Diamond data object
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since Nov 18, 2014
 * @copyright Scottsdale Diamonds, Inc
 */
class Diamond extends Item
{
    public $carat           = null; // float
    public $color           = null; // D-N
    public $clarity         = null; // I1 | I2 | IF | SI1 | SI2 | SI3 | VS1 | VS2 | VVS1 | VVS2
    public $cut             = null; // Ideal | Excellent | Very Good | Good | Fair | Poor | None
    public $shape           = null; // text
    public $polish          = null; // Ideal | Excellent | Very Good | Good | Fair | Poor | None
    public $symmetry        = null; // Ideal | Excellent | Very Good | Good | Fair | Poor | None
    public $fluorescence    = null; // Strong | Medium | Faint | None
    public $table           = null; // float
    public $depth           = null; // float
    public $length          = null; // float
    public $width           = null; // float
    public $price_per_carat = null; // float
    public $net_price       = null; // float
    public $comment         = null; // text
    public $created         = null; // timestamp

    /**
     * Quality map for cut, polish, symmetry
     * @var array
     */
    private static $_quality_map = [
        'n/a' => 'None',
        ''    => 'None',
        'vg'  => 'Very Good',
        'g'   => 'Good',
        'f'   => 'Fair',
        'p'   => 'Poor',
        'e'   => 'Excellent',
        'i'   => 'Ideal'
    ];

    /**
     * Fluorescence map
     * @var array
     */
    private static $_fluor_map = [
        ''            => 'None',
        'n/a'         => 'None',
        'non'         => 'none',
        'fnt'         => 'Faint',
        'med'         => 'Medium',
        'stg'         => 'Strong',
        'vst'         => 'Strong',
        'strong blue' => 'Strong',
    ];

    /**
     * Overrides parent constructor
     * @param array $data
     */
    public function __construct($data)
    {
        parent::__construct($data);
        $this->carat            = isset($this->carat) ? floatval($this->carat) : null;
        $this->color            = ucwords(strtolower($this->color));
        $this->clarity          = strtoupper($this->clarity);
        $this->cut              = strtolower(trim($this->cut));
        $this->cut              = isset(self::$_quality_map[$this->cut]) ? self::$_quality_map[$this->cut] : ucwords($this->cut);
        $this->shape            = ucwords(strtolower($this->shape));
        $this->polish           = strtolower(trim($this->polish));
        $this->polish           = isset(self::$_quality_map[$this->polish]) ? self::$_quality_map[$this->polish] : ucwords($this->polish);
        $this->symmetry         = strtolower(trim($this->symmetry));
        $this->symmetry         = isset(self::$_quality_map[$this->symmetry]) ? self::$_quality_map[$this->symmetry] : ucwords($this->symmetry);
        $this->fluorescence     = strtolower(trim($this->fluorescence));
        $this->fluorescence     = isset(self::$_fluor_map[$this->fluorescence]) ? self::$_fluor_map[$this->fluorescence] : ucwords($this->fluorescence);
        $this->table            = isset($this->table) ? floatval($this->table) : null;
        $this->depth            = isset($this->depth) ? floatval($this->depth) : null;
        $this->length           = isset($this->length) ? floatval($this->length) : null;
        $this->width            = isset($this->width) ? floatval($this->width) : null;
        $this->price_per_carat  = isset($this->price_per_carat) ? floatval($this->price_per_carat) : null;
        $this->net_price        = isset($this->net_price) ? floatval($this->net_price) : null;
        $this->created          = !is_numeric($this->created) ? strtotime($this->created) : $this->created;
    }

    /**
     * Builds the search text field
     */
    public function get_search_text()
    {
        return "$this->carat carat $this->color $this->shape $this->clarity";
    }
}