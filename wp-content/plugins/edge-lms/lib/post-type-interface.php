<?php
namespace EdgefLMS\Lib;

/**
 * interface PostTypeInterface
 * @package EdgefLMS\Lib;
 */
interface PostTypeInterface {
    /**
     * @return string
     */
    public function getBase();

    /**
     * Registers custom post type with WordPress
     */
    public function register();
}