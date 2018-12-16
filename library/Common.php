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
     * Получение стилей и скриптов для $where, где $where - Foot или Head
     */
    static function getScriptsSrc($where){

        try {
            switch ($where) {
                case 'Foot':
                    {
                        $use_func = 'array_pop';
                        break;
                    }
                case 'Head':
                    {
                        $use_func = 'array_shift';
                        break;
                    }
                default:
                    {
                        throw new Exception('Параметр функции \'getScriptsSrc\' не верный');
                }
            }
        }catch (Exception $e){
            return array('css' => array(),'js'=>array());
        }

        $mass = require (ROOT.'/application/configs/css_params.php');
        $styles = !empty($mass) ? $use_func( $mass): array();
        $mass = require (ROOT.'/application/configs/js_params.php');
        $scripts = !empty($mass) ? $use_func( $mass): array();

        return array('css' => $styles,'js'=>$scripts);
    }


    /**
     * @param $where - либо 'Head' или 'Foot'
     * Функция замещает скрипты и стили в DOM HTML
     */
    static  function  getScripts($where){

        $func = "get$where";
        $$where = self::getScriptsSrc($where);

        if(!is_null($$where['css'])){
            foreach ($$where['css'] as $style => $styleSrc){?>
                <link rel="stylesheet" type="text/css" href="<?php echo $styleSrc; ?>" >
            <?php }
        }

        if(!is_null($$where['js'])){
            foreach ($$where['js'] as $script => $scriptSrc){?>
                <script src="<?php echo $scriptSrc; ?>" type="text/javascript"></script>
            <?php }
        }

    }

}