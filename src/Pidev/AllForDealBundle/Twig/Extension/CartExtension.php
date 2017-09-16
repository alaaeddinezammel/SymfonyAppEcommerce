<?php
namespace Pidev\AllForDealBundle\Twig\Extension;

use Symfony\Component\HttpFoundation\Session\Session;

class CartExtension extends \Twig_Extension {

    public function __construct(Session $session) {
        $this->session = $session;
    }

    public function getFunctions() {

        return [new \Twig_SimpleFunction('getCount', [$this, 'getCount'])];
    }

    public function getCount() {

        if (!$this->session->has('panier')) {
            $count = 0;
        } else {
            $count = count($this->session->get('panier'));
        }

        return $count;
    }

    public function getName() {

        return 'cart_extension';
    }

}
