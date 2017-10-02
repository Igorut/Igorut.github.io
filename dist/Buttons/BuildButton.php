<?php
/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 01.10.2017
 * Time: 21:47
 */

namespace App\Buttons;

trait BuildButton
{
    public function checkBuildBtn(): void
    {
        /**
         * If the build button is pressed, will starts function buildDB and
         * that will delete the database and build it again
         * @return void
         */
        if (isset($_POST['build']) && !empty($_POST['number_of_builder'])) {
            $this->buildDB($_POST['number_of_builder']);
        } elseif (!isset($_POST['build']) && empty($_POST['number_of_builder'])) {
            echo 'Введите сколько сотрудников необходимо создать. <br>';
        }
    }
}