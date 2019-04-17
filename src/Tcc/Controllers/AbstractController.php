<?php
namespace Tcc\Controllers;

use Tcc\Resource\Registry\Registry as Registry;

abstract class AbstractController {
    protected $registry;
    protected $repository;

    public function __construct() {
        $this->registry = Registry::getInstance();

        if (!is_null($repository)) {
            $this->repository = $repository;
        }
    }
}