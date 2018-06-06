<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/9/2018
 * Time: 9:37 AM
 */

namespace OC\PlatformBundle\Antispam;


class OCAntispam
{
    /**
     * Vérifie si le texte est un spam ou non
     *
     * @param string $text
     * @return bool
     */
    public function isSpam($text)
    {
        return strlen($text) < 50;
    }
}