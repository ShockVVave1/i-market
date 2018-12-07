<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 07.12.2018
 * Time: 13:07
 */

/**
 * Class Common
 * Класс отвечающий за общие функции
 */
class Common{


    /**
     * @return array
     * Получение стилей и скриптов из header
     */
    static function getHead(){
        $mass = require (ROOT.'/application/configs/css_params.php');
        $styles = !empty($mass) ? array_shift( $mass): array();
        $mass = require (ROOT.'/application/configs/js_params.php');
        $scripts = !empty($mass) ? array_shift( $mass): array();

        return array('css' => $styles,'js'=>$scripts);
    }

    /**
     * @return array
     * Получение стилей и скрипов из footer
     */
    static function getFoot(){
        $mass = require (ROOT.'/application/configs/css_params.php');
        $styles = !empty($mass) ? array_pop( $mass): array();
        $mass = require (ROOT.'/application/configs/js_params.php');
        $scripts = !empty($mass) ? array_pop( $mass): array();


        return array('css' => $styles,'js'=>$scripts);
    }

    /**
     * @param $where - либо 'Head' или 'Foot'
     * Функция замещает скрипты и стили в DOM HTML
     */
    static  function  getScripts($where){

        $func = "get$where";
        $$where = self::$func();

        if(!is_null($$where['css'])){
            foreach ($$where['css'] as $style => $styleSrc){?>
                <link rel="stylesheet" type="text/css" href="<?php echo $styleSrc; ?>" >
            <?php }
        }

        if(!is_null($$where['js'])){
            foreach ($$where['js'] as $script => $scriptSrc){?>
                <script src="<?php echo $scriptSrc; ?>" type="text/javascript">
            <?php }
        }

    }

}