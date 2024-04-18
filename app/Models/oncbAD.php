<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class oncbAD
{
    // error extendsion modified 20230120
    /*
	const PWD_EXPIRED = 1330;
	const PWD_MUST_CHANGE = 1907;
	const ACCOUNT_LOCKED = 1909;
	const ACCOUNT_DISABLED = 1331;
	*/

    private $server = 'ldap://oncbnet.go.th';

    private $port = 389;
    private $username = '';
    public $userinfo = null;
    public $statusinfo = null;

    private $ldap = null;
    private $bind = null;

    private $connected = false;
    public $authed = false;

    private $wsuser = '';
    private $wspass = '';

    private $loginstamp = null;
    private $authstamp = null;
    private $adinfo = null;

    private $statusarr = array(
        'PWD_EXPIRED' => 0,
        'PWD_MUST_CHANGE' => 0,
        'ACCOUNT_LOCKED' => 0,
        'ACCOUNT_DISABLED' => 0,
        'ACCOUNT_EXPIRED' => 0,
        'NOT_AUTHEN' => 1
    );

    public function __construct()
    {
        error_reporting(E_ALL);
        $this->ldap = ldap_connect($this->server, $this->port);
        if ($this->ldap) {
            $this->connected = true;
        }
    }

    public function auth($username, $userpass)
    {
        if (!empty($username)) $this->username = 'oncbnet\\' . $username;
        $this->ldap = ldap_connect($this->server, $this->port);
        if ($this->ldap) {
            ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($this->ldap, LDAP_OPT_REFERRALS, 0);
            ldap_set_option(null, LDAP_OPT_DEBUG_LEVEL, 7);
            $this->connected = true;

            try {
                $this->bind = ldap_bind($this->ldap, $this->username, $userpass);


                if ($this->bind) {
                    $this->authed = true;
                    $this->userinfo = null;
                    $this->statusarr['NOT_AUTHEN'] = 0;

                    $filter = "(sAMAccountName=$username)";
                    $result = ldap_search($this->ldap, "dc=oncbnet,dc=go,dc=th", $filter);
                    $this->adinfo = ldap_get_entries($this->ldap, $result);
                    $this->userinfo = $this->ONCBNETgetUSerInfo();
                } else {
                    // error extendsion modified 20230120
                    $this->authed = false;
                    $this->userinfo = null;
                    $this->adinfo =  null;
                    $this->statusarr['NOT_AUTHEN'] = 1;
                }
            } catch (Exception $e) {
                $this->authed = false;
                $this->userinfo = null;
                $this->adinfo =  null;
                // exit();
            }
        } else {
            // syslog(LOG_ERR, "Unable to connect to LDAP server." . ldap_error($this->ldap));
            $this->authed = false;
            $this->userinfo = null;
            $this->adinfo =  null;
            // exit();
        }

        return $this;
    }
    private function getExtendedErrorNumber()
    {
        $errorNumber = 0;
        ldap_get_option($this->ldap, LDAP_OPT_ERROR_STRING, $extendedError);
        if (!empty($extendedError) && preg_match('/, data (\d+),?/', $extendedError, $matches)) {
            $errorNumber = hexdec(intval($matches[1]));
        }
        return $errorNumber;
    }

    private function chkUserStatus($username)
    {
        $this->ldap = ldap_connect($this->server, $this->port);
        if ($this->ldap) {
            ldap_set_option($this->ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($this->ldap, LDAP_OPT_REFERRALS, 0);
            $this->connected = true;

            $this->bind = ldap_bind($this->ldap, $this->wsuser, $this->wspass);

            if ($this->bind) {
                $this->authed = true;
                $this->userinfo = null;
                $this->adinfo = null;
                $filter = "(sAMAccountName=$username)";
                $result = ldap_search($this->ldap, "dc=oncbnet,dc=go,dc=th", $filter);
                $this->userinfo = ldap_get_entries($this->ldap, $result);
            } else {
                $this->authed = false;
                $this->userinfo = null;
                $this->adinfo = null;

                syslog(LOG_ERR, "Unable to bind to LDAP server.");
                exit();
            }
        } else {
            syslog(LOG_ERR, "Unable to connect to LDAP server.");
            exit();
        }
        return $this->statusinfo;
    }
    public function getConnected()
    {
        return $this->connected;
    }
    public function getUserinfo()
    {
        return $this->userinfo;
    }
    public function getStatusInfo()
    {
        return $this->statusinfo;
    }
    public function close()
    {
        $this->connected = false;
        $this->authed = false;
        @ldap_close($this->ldap);
    }

    public function ONCBNETgetUSerInfo()
    {
        if (sizeof($this->adinfo) > 0) {
            var_dump($this->adinfo);
            $userinfo = array();
            array_push($userinfo, array("userid" => $this->adinfo[0]['samaccountname'][0]));
            array_push($userinfo, array("ENname" => $this->adinfo[0]['displayname'][0]));
            array_push($userinfo, array("THname", isset($this->adinfo[0]['physicaldeliveryofficename'][0]) ? $this->adinfo[0]['physicaldeliveryofficename'][0] : ''));
            array_push($userinfo, array("mail" => isset($this->adinfo[0]['mail'][0]) ? $this->adinfo[0]['mail'][0] : ''));
            array_push($userinfo, array("department" => $this->adinfo[0]['department'][0]));
            array_push($userinfo, array("logintime" => $this->authstamp));
            array_push($userinfo, array(
                "role" => array(
                    "rolebsp" => (isset($this->adinfo[0]['rolebsp'][0]) ? $this->adinfo[0]['rolebsp'][0] : ''),
                )
            ));
            array_push($userinfo, array("depart_id" => $this->adinfo[0]['ou'][0]));
            array_push($userinfo, array("employeeid" => isset($this->adinfo[0]['employeeid'][0]) ? $this->adinfo[0]['employeeid'][0] : ''));
            array_push($userinfo, array("employeenumber" => isset($this->adinfo[0]['employeenumber'][0]) ? $this->adinfo[0]['employeenumber'][0] : ''));
            array_push($userinfo, array("division" => isset($this->adinfo[0]['division'][0]) ? $this->adinfo[0]['division'][0] : ''));
        }
        return $userinfo;
    }
}
