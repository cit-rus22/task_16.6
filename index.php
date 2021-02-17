<?php
$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];


function getFullNameFromParts($surname1, $name1, $patronomyc1) {
  $fullnameFrom = $surname1 .' '. $name1 .' '. $patronomyc1;
  return $fullnameFrom;
}

/* $surname1 = "Авдонин";
$name1 = "Борис";
$patronomyc1 = "Вадимович";

getFullNameFromParts($surname1, $name1, $patronomyc1); */

function getPartsFromFullname($fio2) {
  $fullFromPart = explode(" ", $fio2);
  $keys = ["surname", "name", "patronomyc"];
  /* print_r($fullFromPart); */
  /* print_r($keys); */
  $finalArray = array_combine($keys, $fullFromPart);
  return $finalArray;
};

/* getPartsFromFullname("Авдонин Борис Вадимович"); */

function getShortName($fio3) {
  $a = getPartsFromFullname($fio3);
  $b = $a['surname'] .' '. mb_substr($a['name'], 0, 1) . '.';
  return $b;
};

/* getShortName("Авдонин Борис Вадимович"); */

function getGenderFromName($fio4) {
  $a = getPartsFromFullname($fio4);
  $genderAttr = 0;

    /* Проверка на фамилию */
    if (mb_substr($a['surname'], -2, 2) == "ва") {
        $genderAttr--;
        echo $genderAttr;
        } elseif (mb_substr($a['surname'], -1, 1) == "в") {
        $genderAttr++;
        echo $genderAttr;
        } else {
             echo "Фамилия не пройдёт";
        }

  /* Проверка на имя */
  if ((mb_substr($a['name'], -1, 1)) == "а") {
      $genderAttr--;
      echo $genderAttr;
  } elseif (mb_substr($a['name'], -1, 1) == "й" || mb_substr($a['name'], -1, 1) == "н") {
      $genderAttr++;
      echo $genderAttr;
  } else {
       echo "Имя не пройдёт";
  }

  /* Проверка на отчество */
  if (mb_substr($a['patronomyc'], -3, 3) == "вна") {
    $genderAttr--;
    echo $genderAttr;
    } elseif (mb_substr($a['patronomyc'], -2, 2) == "ич") {
    $genderAttr++;
    echo $genderAttr;
    } else {
         echo "Отчество не пройдёт";
    }
    

    if ($genderAttr > 0) {
        return 1;
    } 
    elseif ($genderAttr < 0) {
        return -1;
    }
    else {
        return 0;
    }
}

/* $a = getGenderFromName("Иванова Антон Анатольевич");
var_dump($a); */
    
function getGenderDescription($example_persons_array) {
    $personNumber = count($example_persons_array);
    $fullNameOnly = [];
    foreach($example_persons_array as $key => $value) {
            $fullNameOnly[] = $value['fullname'];
    };

    $m = 0;
    $f = 0;
    $n = 0;

    for($i = 0; $i < $personNumber; $i++) {
        if(getGenderFromName($fullNameOnly[$i]) == 1){
            $m++;
        }
        elseif(getGenderFromName($fullNameOnly[$i]) == -1){
            $f++;
        }
        else{
            $n++;
        }
    }

echo 'Гендерный состав аудитории:' . '</br>';
echo '---------------------------' . '</br>';
echo 'Мужчины - '. round(100*$m/$personNumber, 1) . '%' . '</br>';
echo 'Женщины - '. round(100*$f/$personNumber, 1) . '%' . '</br>';
echo 'Не удалось определить - '. round(100*$n/$personNumber, 1) . '%';

};

/* getGenderDescription($example_persons_array); */


function getPerfectPartner($surname6, $name6, $patronomyc6, $example_persons_array){
    $surnameUpper = mb_convert_case($surname6, MB_CASE_TITLE_SIMPLE);
    $nameUpper = mb_convert_case($name6, MB_CASE_TITLE_SIMPLE);
    $patronomycUpper = mb_convert_case($patronomyc6, MB_CASE_TITLE_SIMPLE);

    $fullname1 = getFullnameFromParts($surnameUpper, $nameUpper, $patronomycUpper);
    $gender1 = getGenderFromName($fullname1);

    function getRandPerson($example_persons_array) {
    $randNumber = rand(0, count($example_persons_array)-1);
    $fullnameRand = $example_persons_array[$randNumber]['fullname'];
    return $fullnameRand;
    }

    if ($gender1 == 0) {
        echo "Неизвестный пол";
    } else {
        do {
            $fullname2 = getRandPerson($example_persons_array);
            $gender2 = getGenderFromName($fullname2);
        } while ($gender1 == $gender2);
    }
 
    $shortName1 = getShortName($fullname1);
    $shortName2 = getShortName($fullname2);

  
     echo $shortName1 . ' + ' . $shortName2 . ' =' . '<br>';
  echo '♡'. ' Идеально на '. rand(50, 100). '% ' .'♡';
}

/* getPerfectPartner('Степанова','екатериНа','влаДИМИРОВна', $example_persons_array); */

?>