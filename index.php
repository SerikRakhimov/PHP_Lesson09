<?php
//Создать класс Matrix:

class Matrix
{
    private array $classArray;

    public function __construct(array $arr)

    {
        $this->setClassArray($arr);
    }

    public function add(Matrix $matrix)
    {
        $this->funcAAddDiff($matrix, 1);
    }

    public function diff(Matrix $matrix)
    {
        $this->funcAAddDiff($matrix, -1);
    }

    protected function funcAAddDiff(Matrix $matrix, int $koef)
    {
        $arrResult = [];
        $arrOne = $this->getClassArray();
        $arrTwo = $matrix->toArray();
        $rowsCount = max(count($arrOne), count($arrTwo));
        if ($rowsCount > 0) {
            $colsCount = count($arrOne[0]);

            foreach ($arrOne as $value) {
                $colsCount = max($colsCount, count($value));
            }
            foreach ($arrTwo as $value) {
                $colsCount = max($colsCount, count($value));
            }
            for ($i = 0; $i < $rowsCount; $i++) {
                for ($j = 0; $j < $colsCount; $j++) {
                    $arrResult[$i][$j] = (isset($arrOne[$i][$j]) ? $arrOne[$i][$j] : 0) + $koef * (isset($arrTwo[$i][$j]) ? $arrTwo[$i][$j] : 0);
                }

            }
        }
        $this->setClassArray($arrResult);
    }

    public function mult(Matrix $matrix)
    {
        $arrResult = [];
        $arrOne = $this->getClassArray();
        $arrTwo = $matrix->toArray();
        $rowsOne = count($arrOne);
        $rowsTwo = count($arrTwo);
        if ($rowsOne > 0 && $rowsTwo > 0) {
            $colsOne = count($arrOne[0]);
            foreach ($arrOne as $value) {
                $colsOne = max($colsOne, count($value));
            }
            // если число столбцов первого массива совпадает с числом строк второго массива
            if ($colsOne == $rowsTwo) {
                $colsTwo = count($arrTwo[0]);
                foreach ($arrTwo as $value) {
                    $colsTwo = max($colsTwo, count($value));
                }
                for ($i = 0; $i < $rowsOne; $i++) {
                    for ($j = 0; $j < $colsTwo; $j++) {
                        $sum = 0;
                        for ($k = 0; $k < $colsOne; $k++) {
                            $sum += (isset($arrOne[$i][$k]) ? $arrOne[$i][$k] : 1) * (isset($arrTwo[$k][$j]) ? $arrTwo[$k][$j] : 1);
                        }
                        $arrResult[$i][$j] = $sum;
                    }

                }
                $this->setClassArray($arrResult);
            } else {
                echo nl2br("\nЧисло столбцов первого массива не совпадает с числом строк второго массива!\n");
            }
        }
    }

    public function toArray(): array
    {
        return $this->getClassArray();
    }

    public function print(string $text)
    {
        echo nl2br("\n" . $text . "\n");
        $arr = $this->getClassArray();
        foreach ($arr as $rowValue) {
            foreach ($rowValue as $colValue) {
                echo $colValue . ", ";
            }
            echo nl2br("\n");

        }
    }

    private function setClassArray(array $arr)
    {
        $this->classArray = $arr;
    }

    private function getClassArray(): array
    {
        return $this->classArray;
    }

}

$arrFirst = [[10, 30],
    [10, 20],
    [100, 40],
];
$matrixFirst = new Matrix($arrFirst);
$matrixFirst->print('Первый массив:');

$arrSecond = [[1, 3, 15],
    [10,120,80],
    [3,40,50],
    [5],
];
$matrixSecond = new Matrix($arrSecond);
$matrixSecond->print('Второй массив:');

$matrixFirst->add($matrixSecond);
$matrixFirst->print('Результат сложения двух массивов:');

$matrixFirst->__construct($arrFirst);
$matrixFirst->diff($matrixSecond);
$matrixFirst->print('Результат вычитания двух массивов:');

$arrFirst = [[10, 30],
    [10, 20],
    [100, 40],
];
$matrixFirst->__construct($arrFirst);
$matrixFirst->print('Первый массив:');

$arrSecond = [[1, 3, 5, 10],
    [2, 5, 50, 20]
];

$matrixSecond->__construct($arrSecond);
$matrixSecond->print('Второй массив:');

$matrixFirst->mult($matrixSecond);
$matrixFirst->print('Результат умножения двух массивов:');