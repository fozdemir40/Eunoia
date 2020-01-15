<?php namespace System\Form;

/**
 * Class Data
 * @package System\Form
 */
class Data
{
    private $post = [];

    /**
     * Data constructor.
     * @param array $post
     */
    public function __construct(array $post)
    {
        $this->post = $post;
    }

    /**
     * @param string $var
     * @return bool
     */
    public function varExists(string $var): bool
    {
        return array_key_exists($var, $this->post);
    }

    /**
     * @param string $var
     * @return string
     */
    public function getPostVar(string $var): string
    {
       return htmlentities($this->post[$var]);
    }


    /**
     * @param string $var
     * @return string
     */
    public function getGetVar(string $var): string
    {
        return htmlentities($this->post[$var]);
    }


    /**
     * @param string $val
     * @param int $x
     * @param int $y
     * @return bool
     */
    static public function between(string $val, int $x, int $y): bool
    {
        $val_len = strlen($val);
        return ($val_len >= $x && $val_len <= $y)?TRUE:FALSE;
    }


}