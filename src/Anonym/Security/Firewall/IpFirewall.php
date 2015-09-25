<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */

namespace Anonym\Security\Firewall;

use Anonym\Security\Exception\FirewallException;
use M6Web\Component\Firewall\Firewall as ParentFirewall;

/**
 * Class Firewall
 * @package Anonym\Security
 */
class IpFirewall extends ParentFirewall implements FirewallCheckerInterface
{

    /**
     * sınıfı başlatır
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Yakalama işlemini yapar veya exception oluşturur
     *
     * @return bool
     */
    public function handle()
    {
        return parent::handle([$this, 'getException']);
    }

    /**
     * Exception oluşturur
     */
    public function getException()
    {
        throw new FirewallException('Giriş yaptığınız adres, güvenlik duvarımıza takılmıştır.');
    }
}
