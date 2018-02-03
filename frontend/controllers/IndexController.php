<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class IndexController extends Controller
{
    //模拟微信红包
    public function actionIndex()
    {
        $total_money = 200;
        $people_num = 20;
        $rangeArr = range(0, $total_money * 100);
        unset($rangeArr[0], $rangeArr[count($rangeArr)]);
        $tmp = array_rand($rangeArr, $people_num - 1);
        $tmp[] = 0;
        $tmp[] = end($rangeArr) + 1;
        sort($tmp);
        $lastArr = array();
        foreach ($tmp as $k => $v) {
            if ($k + 1 != count($tmp)) {
                $lastArr[] = sprintf("%'01.2f", (($tmp[$k + 1] - $v) / 100));    //保留两位小数 不足补零
                //$lastArr[] = ($tmp[$k + 1] - $v) / 100;   //不保留两位小数
            }
        }
        $this->dump($lastArr);
        $this->dump(array_sum($lastArr));
        unset($total_money, $lastArr, $tmp, $people_num, $rangeArr);
        exit();
    }

    function actionMinRand()
    {
        header("Content-type: text/html; charset=utf-8");
        $total_money = 10 * 100;
        $people_num = 3;
        $min_money = 3.3 * 100;
        if ($min_money > $total_money / $people_num) {    //最小值不能大于平均值 $total_money/$people_num
            echo '最小值不能大于平均值';
            exit();
        }
        $tp_arr = array();
        $tmp_total = 0;
        $tmp_people = $people_num;
        for ($i = 0; $i < $tmp_people; $i++) {
            if (($i + 1) == $tmp_people) {
                //$tp_arr[] = $total_money;
                $tp_arr[] = sprintf("%'01.2f", $total_money / 100);
                $tmp_total += $total_money;
            } else {
                $tmp_max_money = $total_money - ($people_num - 1) * $min_money;
                $tmp_money = mt_rand($min_money, $tmp_max_money);
                $total_money -= $tmp_money;
                $people_num -= 1;
                $tp_arr[] = sprintf("%'01.2f", $tmp_money / 100);
                $tmp_total += $tmp_money;
            }
        }
        $this->dump($tp_arr);
        $this->dump(count(($tp_arr)));
        $this->dump($tmp_total / 100);
    }

    private function dump($var, $echo = true, $label = null, $strict = true)
    {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        } else
            return $output;
    }

    public function actions()
    {
    }
}
