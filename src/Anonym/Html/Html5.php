<?php
/**
 *  This file belongs to AnonymPHP Framework
 *
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @website http://anonymphp.com/framework
 */

namespace Anonym\Html;

/**
 * Class Html5
 * @package Anonym\Html
 */
class Html5
{

    /**
     * @param string $attributes
     * @return string
     */
    public static function attributes($attributes = '')
    {
        $attribute = '';

        if (is_array($attributes)) {
            foreach ($attributes as $key => $values) {
                if (is_numeric($key))
                    $key = $values;
                $attribute .= ' ' . $key . '="' . $values . '"';
            }
        }

        return $attribute;
    }


    // Yeni Form Özellikleri
    /*
        “autofocus” ile sayfa yüklendiğinde ilgili text alanına otomatik olarak odaklanma yapılabilir.

      “placeholder” sayesinde eskiden JavaScript ile yapılan, text alanının üstüne odaklanıldığında kaybolan tanımlar eklenebilir.

      “required” ile herhangi bir JavaScript kodu kullanmadan metin, sayı, e-posta gibi verilerin form kontrolü yapılabilir.

      “autocomplete” özelliği ile kullanıcının daha önce girdiği değerlere göre otomatik tamamlama özelliği aktif ya da pasif duruma alınabilir. “on” veya “off” değerlerini alır.

      “min” ve “max” değerleri ile sayı, tarih, aralık gibi veri tiplerinde minimum ve maximum alınabilecek değerler belirtilebilir.

      “step” değeri “min” ve “max” değerleri arasındaki eksiltme ya da arttırma aralığı belirtir.
          Aşağıdaki örnekte girilen sayı alt ve üst sınır içinde 10’ar 10’ar eksiltilir ya da arttırabilir.

      “pattern” ile kullanıcıdan belirlenen standartta veri alınabilmesi sağlanabilir.
          Örnekte, kullanıcıdan 0 ile 9 arasında 2 tane rakam – a ile z arasında 6 tane küçük harf yazması istenmiştir. A-Z olsaydı, büyük harf yazılması gerekecekti.
    */

    public static function formOpen($name = '', $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";
        if (isset($_attributes['enctype'])) {
            switch ($_attributes['enctype']) {
                case "multipart"    :
                    $_attributes['enctype'] = 'multipart/form-data';
                    break;
                case "application"    :
                    $_attributes['enctype'] = 'application/x-www-form-urlencoded';
                    break;
                case "text"        :
                    $_attributes['enctype'] = 'text/plain';
                    break;
            }
        }
        if (!isset($_attributes['method'])) $_attributes['method'] = 'post';

        return '<form name="' . $name . '" ' . $id_txt . ' ' . self::attributes($_attributes) . '>' . "\n";
    }

    public static function form_close()
    {
        return '</form>' . "\n";
    }

    //email : E-Mailler için

    /**
     * @param string $name
     * @param string $value
     * @param string $_attributes
     * @return string
     */
    public static function emailObject($name = '', $value = '', $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="email" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //url : url girebilmek için

    /**
     * @param string $name
     * @param string $value
     * @param string $_attributes
     * @return string
     */
    public static function urlObject($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="url" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //number : sadece rakam yazmak için. min, max, step ve value öznitelikleri tanımlanabilir.
    public static function number_object($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="number" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //search : arama inputları için

    /**
     * @param string $name
     * @param string $value
     * @param string $_attributes
     * @return string
     */
    public static function searchObject($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="search" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //tel : telefon yazmak için

    public static function telObject($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="tel" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //color : renkler için

    public static function colorObject($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="color" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //date : doğumgünü, yıldönümü vs için.

    public static function dateObject($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="date" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //datetime : date tipine ek olarak saati de kapsamaktadır.

    public static function datetimeObject($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="datetime" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //datetime-local : datetime tipine ek olarak zaman dilimi tanımlar.

    public static function datetimeLocalObject($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="datetime-local" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //time : Saat için kullanılır.

    public static function timeObject($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="time" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //week : hafta bilgisini yazmak için kullanılır.

    public static function weekObject($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="week" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //month : Ay bilgisini yazmak için kullanılır.

    /**
     * @param string $name
     * @param string $value
     * @param string $_attributes
     * @return string
     */
    public static function monthObject($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="month" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //range : Fiyat aralığı vb yazmak için kullanılır. min, max, step ve value öznitelikleri tanımlanabilir.

    /**
     * @param string $name
     * @param string $value
     * @param string $_attributes
     * @return string
     */
    public static function rangeObject($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";

        return '<input type="range" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    /**
     * @param string $name
     * @param string $value
     * @param string $_attributes
     * @return string
     */
    public static function imageObject($name = "", $value = "", $_attributes = '')
    {
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";
        return '<input type="image" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    /**
     * @param string $type
     * @param string $name
     * @param string $value
     * @param string $_attributes
     * @return bool|string
     */
    public static function inputObject($type = "", $name = "", $value = "", $_attributes = '')
    {
        if (!is_string($type)) return false;
        if (!is_string($name)) $name = '';
        if (!(is_string($value) || is_numeric($value))) $value = '';

        $value = (!empty($value)) ? 'value="' . $value . '"' : "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";
        return '<input type="' . $type . '" name="' . $name . '" ' . $id_txt . ' ' . $value . self::attributes($_attributes) . '>' . "\n";
    }

    //Üst Bölüm
    /**
     * @param string $html
     * @return string
     */
    public static function header($html = "")
    {
        if (!(is_string($html) || is_numeric($html))) $html = '';
        $str = "<header>" . $html . "</header>";
        return $str;
    }

    //Alt Bölüm
    /**
     * @param string $html
     * @return string
     */
    public static function footer($html = "")
    {
        if (!(is_string($html) || is_numeric($html))) $html = '';
        $str = "<footer>" . $html . "</footer>";
        return $str;
    }

    //Menü Bölümünü Oluşturuyour
    /**
     * @param string $html
     * @return string
     */
    public static function nav($html = "")
    {
        if (!(is_string($html) || is_numeric($html))) $html = '';
        $str = "<nav>" . $html . "</nav>";
        return $str;
    }

    //Makalelerin Listeleneceğil Alan olarak Düşünüşüyor
    /**
     * @param string $html
     * @return string
     */
    public static function article($html = "")
    {
        if (!(is_string($html) || is_numeric($html))) $html = '';
        $str = "<article>" . $html . "</article>";
        return $str;
    }

    //Reklam Alanı Olarak Düşünülüyor
    /**
     * @param string $html
     * @return string
     */
    public static function aside($html = "")
    {
        if (!(is_string($html) || is_numeric($html))) $html = '';
        $str = "<aside>" . $html . "</aside>";
        return $str;
    }

    //Bölümler oluşturmak için
    /**
     * @param string $html
     * @return string
     */
    public static function section($html = "")
    {
        if (!(is_string($html) || is_numeric($html))) $html = '';
        $str = "<section>" . $html . "</section>";
        return $str;
    }

    //Başlık gurupları oluşturmak için kullanılması düşünülüyor
    /**
     * @param string $html
     * @return string
     */
    public static function hgroup($html = "")
    {
        if (!(is_string($html) || is_numeric($html))) $html = '';
        $str = "<hgroup>" . $html . "</hgroup>";
        return $str;
    }

    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function canvas($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<canvas' . self::attributes($_attributes) . '>' . $content . "</canvas>\n";
    }

    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function datalist($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<datalist' . self::attributes($_attributes) . '>' . $content . "</datalist>\n";
    }

    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function output($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<output' . self::attributes($_attributes) . '>' . $content . "</output>\n";
    }

    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function details($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<details' . self::attributes($_attributes) . '>' . $content . "</details>\n";
    }

    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function summary($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<summary' . self::attributes($_attributes) . '>' . $content . "</summary>\n";
    }

    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function figure($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<figure' . self::attributes($_attributes) . '>' . $content . "</figure>\n";
    }


    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function figcaption($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<figcaption' . self::attributes($_attributes) . '>' . $content . "</figcaption>\n";
    }

    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function mark($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<mark' . self::attributes($_attributes) . '>' . $content . "</mark>\n";
    }

    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function time($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<time' . self::attributes($_attributes) . '>' . $content . "</time>\n";
    }

    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function dialog($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<dialog' . self::attributes($_attributes) . '>' . $content . "</dialog>\n";
    }

    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function command($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<command' . self::attributes($_attributes) . '>' . $content . "</command>\n";
    }

    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function meter($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<meter' . self::attributes($_attributes) . '>' . $content . "</meter>\n";
    }

    /**
     * @param string $content
     * @param string $_attributes
     * @return string
     */
    public static function progress($content = "", $_attributes = '')
    {
        if (!(is_string($content) || is_numeric($content))) $content = '';
        return '<progress' . self::attributes($_attributes) . '>' . $content . "</progress>\n";
    }

    /**
     * @param string $_attributes
     * @return string
     */
    public static function keygen($_attributes = '')
    {
        return '<keygen' . self::attributes($_attributes) . '>' . "\n";
    }

    /**
     * @param string $src
     * @param string $_attributes
     * @param string $name
     * @return string
     */
    public static function embed($src = "", $_attributes = '', $name = '')
    {
        if (!is_string($src)) $src = "";
        $id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
        if (!isset($_attributes["id"])) $id_txt = 'id="' . $id . '"'; else $id_txt = "";
        return '<embed src="' . $src . '"' . self::attributes($_attributes) . '>' . "\n";
    }

    /**
     * @param string $src
     * @param array $attributes
     * @return string
     */
    public static function source($src = "", $attributes = array(""))
    {
        if (!is_string($src)) $src = "";
        $str = "<source src='" . $src . "'" . self::attributes($attributes) . " />";
        return $str;
    }

    //PARAMETERS
    //src=url Gösterilmek istenen vidyonun URL'sini tanımlar
    //autoplay=autoplay videonun otomati olarak çalışmaya başlayacağını belirtir
    //controls=controls Oynatma ve durdurma gibi kontrol düğmeleri eklenir.
    //height=pixel Video gösterimi için yükseklik değeri belirtir.
    //width=pixel Video göstermi için genişlik değeri belirtir.
    //loop=loop Vidyonun bitince yeniden oynatılacağını belirtir.
    //preload=preload Belirtilen vidyo için ön yükleme yapar

    /**
     * @param string $src
     * @param string $content
     * @param array $attributes
     * @return string
     */
    public static function video($src = "", $content = "", $attributes = array(""))
    {
        if (!is_string($src)) $src = "";
        if (!(is_string($content) || is_numeric($content))) $content = '';
        $str = "<video src='" . $src . "'" . self::attributes($attributes) . ">" . $content . "</video>";
        return $str;
    }

    //PARAMETERS
    //src=url Gösterilmek istenen vidyonun URL'sini tanımlar
    //autoplay=autoplay videonun otomati olarak çalışmaya başlayacağını belirtir
    //controls=controls Oynatma ve durdurma gibi kontrol düğmeleri eklenir.
    //height=pixel Video gösterimi için yükseklik değeri belirtir.
    //width=pixel Video göstermi için genişlik değeri belirtir.
    //loop=loop Vidyonun bitince yeniden oynatılacağını belirtir.
    //preload=preload Belirtilen vidyo için ön yükleme yapar
    /**
     * @param string $src
     * @param string $content
     * @param array $attributes
     * @return string
     */
    public static function audio($src = "", $content = "", $attributes = array(""))
    {
        if (!is_string($src)) $src = "";
        if (!(is_string($content) || is_numeric($content))) $content = '';
        $str = "<audio src=" . $src . " " . self::attributes($attributes) . ">" . $content . "</audio>";
        return $str;
    }
}
