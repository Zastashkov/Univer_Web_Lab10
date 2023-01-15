<?php
@$text = $_POST['text'];
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Засташков Даниил Лаб 10</title>
</head>

<body>
<header>
    <div class="logo">
        <img src="https://old.mospolytech.ru/img_new/top_bn/top_sh.png"
             alt="mospolytech-logo">
    </div>
    <div class="title">
        <h1><a href="/10lab">Лабораторная работа №10</a></h1>
        <h2>Засташков Даниил</h2>
        <h2>211-361</h2>
    </div>
</header>
<main>
    <div class="text-block">
        <p>
            <?php

            if (isset($text) && $text != '') {
                echo $text;
            } else {
                echo "Нет текста для анализа";
            }
            ?>
        </p>
    </div>
    <div class="text-analysis">
        <!--        1. количество символов в тексте (включая пробелы);-->
        <!--        2. количество букв;-->
        <!--        3. количество строчных и заглавных букв по отдельности;-->
        <!--        4. количество знаков препинания;-->
        <!--        5. количество цифр;-->
        <!--        6. количество слов;-->
        <!--        7. количество вхождений каждого символа текста (без различия верхнего и нижнего регистров);-->
        <!--        8. список всех слов в тексте и количество их вхождений, отсортированный по алфавиту.-->
        <h3>Анализ текста</h3>
        <p>
            1. Количество символов в тексте (включая пробелы): <?= mb_strlen(
                $text
            ) ?>
        </p>
        <p>
            2. Количество букв: <?= mb_strlen(
                preg_replace("/[^a-zA-Zа-яА-Я]/u", "", $text)
            ) ?>
        </p>
        <p>
            3. Количество строчных и заглавных букв по
            отдельности: <?= mb_strlen(
                preg_replace("/[^a-zа-я]/u", "", $text)
            ) ?> строчных и <?= mb_strlen(
                preg_replace("/[^A-ZА-Я]/u", "", $text)
            ) ?> заглавных

        </p>
        <p>
            4. Количество знаков препинания: <?= mb_strlen(
                preg_replace("/[^.,:;!?-]/u", "", $text)
            ) ?>
        </p>
        <p>
            5. Количество цифр: <?= mb_strlen(
                preg_replace("/[^0-9]/u", "", $text)
            ) ?>
        </p>
        <p>
            6. Количество слов: <?= count(explode(" ", $text)) ?>
        </p>
        <p>
            7. Количество вхождений каждого символа текста (без различия
            верхнего и нижнего регистров):
            <br>
        <div class="words-block">
            <table>
                <tr>
                    <th>Символ</th>
                    <th>Кол-во</th>
                </tr>
                <!--            массив со всеми символами в коде-->
                <?php
                $symbols = array();
                for ($i = 0; $i < mb_strlen($text); $i++) {
                    array_push(
                        $symbols,
                        mb_strtolower(
                            mb_substr($text, $i, 1)
                        )
                    );
                }
                ?>
                <!--            массив уникальных символов в коде-->
                <?php
                $unique_symbols = array_unique($symbols);
                ?>

                <!--            массив с уникальными символами и их частотой в коде-->
                <?php
                $unique_symbols_freq = array();

                foreach ($unique_symbols as $symbol) {
                    $unique_symbols_freq[$symbol] = 0;
                }
                foreach ($symbols as $symbol) {
                    $unique_symbols_freq[$symbol]++;
                }
                ?>
                <!--            массив с символами и их частотой в коде-->
                <?php
                foreach ($unique_symbols_freq as $unique_symbol => $frequency) {
                    if ($unique_symbol == " ") $unique_symbol = "'space'";
//                echo '<div class="word-block">';
                    echo '<tr>';
                    echo "<th>$unique_symbol</th><th>$frequency</th>";
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
        </p>
        <p>
            8. Список всех слов в тексте и количество их вхождений,
            отсортированный по алфавиту:
        </p>
        <div class="words-block">

            <table>
                <!--            массив всех слов в коде-->
                <?php
                //            replace non word characters with empty string

                $words = explode(
                    " ",
                    preg_replace("/[^a-zA-Zа-яА-Я]/u", " ", $text)
                );
                //            remove empty elements from array
                $words = array_filter($words);
                ?>
                <!--            массив уникальных слов в коде-->
                <?php
                $unique_words = array_unique($words);
                ?>
                <!--            массив уникальных слов и их частоты в коде-->
                <?php
                $unique_words_freq = array();
                foreach ($unique_words as $unique_word) {
                    $unique_words_freq[$unique_word] = 0;
                }
                foreach ($words as $word) {
                    $unique_words_freq[$word]++;
                }
                ksort($unique_words_freq);
                ?>
                <!--            print-->
                <?php
                foreach ($unique_words_freq as $unique_word => $frequency) {
//                echo '<div class="word-block">';
                    echo '<tr>';
                    echo "<th>$unique_word</th><th>$frequency</th>";
                    echo '</tr>';
                }
                ?>
            </table>
            <div class="button-block">
                <form action="/10lab">
                    <input type="submit" value="Провести другой анализ"/>
                </form>
            </div>
        </div>
    </div>
</main>

</body>

</html>