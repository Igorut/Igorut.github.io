<?php
/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 01.10.2017
 * Time: 21:47
 */

namespace App\Buttons;

trait ResponseButton
{
    public function checkGetResponse(): array
    {
        /**
         * If the get button is pressed, will starts function getPersonal,
         * that will return an array of staff
         * @return array
         */
        if (isset($_POST['get_staff']) && !empty($_POST['number_of_staff'])) {
            echo 'Выведено: ' . $_POST['number_of_staff'];
            return $this->getPersonal($_POST['number_of_staff']);
        }
        echo 'Введите сколько сотрудников необходимо вывести. <br>';
        return [];
    }
}