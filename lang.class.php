<?php
/**
 *
 * @author Dominik Ryńko
 * @contact: http://www.rynko.pl/kontakt
 * @version 1.0.0
 * @license http://creativecommons.org/licenses/by-sa/3.0/pl/
 */

/**
 * Class lang
 */
class Lang
{
    /**
     * @var
     */
    public static $lang;

    /**
     * @var array
     */
    public $config = [
        'defaultLang' => 'pl',
        'cookieName' => 'lang',
        'defaultLocation' => 'index.php',
        'langsPath' => './langs/',
        'fileExtension' => '.lang.php'
    ];

    /**
     * @Description: call method include_lang() and getDefaultLang()
     */
    public function __construct()
    {
        $this->includeLang();
        $this->getDefaultLang();
    }

    /**
     * @param $lang
     * @throws Exception
     */
    public function setLang($lang)
    {
        $lang = $this->clear($lang);

        if ($_COOKIE['lang']) {
            unset($_COOKIE['lang']);
        }

        $short = [];

        foreach ($this->scanAvailableLangs() as $key => $value) {
            $data[] = explode('.', $value);
            $short[] = $data[$key][0];
        }

        if (in_array($lang, $short)) {
            setcookie($this -> config['cookieName'], $lang);
            header('Location:' . $this->config['defaultLocation']);
        } else {
            throw new Exception('There is no language in langs/ dir like ' . $lang . ')');
        }
    }

    /**
     * @return null
     */
    private function getDefaultLang()
    {
        if (is_null($this->config['defaultLang']) || empty($this->config['defaultLang'])) {
            $this->config['defaultLang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        }
        return null;
    }

    /**
     * @throws Exception
     */
    private function includeLang()
    {
        if (empty($_COOKIE['lang'])) {
            setcookie($this -> config['cookieName'], $this->config['defaultLang']);
            header('Location:'. $this -> config['defaultLocation']);
        } else {
            $clear = $this->clear($_COOKIE[$this -> config['cookieName']]);
            $lang = '';

            if (preg_match('/[A-za-z0-9]/', $clear)) {
                include $this -> config['langsPath'].$clear.$this -> config['fileExtension'];
                self::$lang = $lang;
            } else {
                throw new Exception('Regex does not match to the name of lang in cookie');
            }
        }
    }

    /**
     * @return array
     * @throws Exception
     */
    private function scanAvailableLangs()
    {
        $files = glob($this -> config['langsPath'].'*{'.$this -> config['fileExtension'].'}', GLOB_BRACE);

        foreach ($files as $key => $value) {
            $langs[] = explode('/', $value);
            $short[] = end($langs[$key]);
        }

        if (empty($short)) {
            throw new Exception('There are no available languages');
        } else {
            return $short;
        }
    }

    /**
     * @param $data
     * @return string
     */
    private function clear($data)
    {
        return trim(htmlspecialchars($data));
    }
}
