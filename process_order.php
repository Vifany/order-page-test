<?php

const API_URL = 'https://order.drcash.sh/v1/order';
//const API_URL = 'localhost:3001/v1/order';

// Валидация телефона регэксом
function validatePhoneNumber($phoneNumber)
{
    $pattern = '/(?:\+|\d)[\d\-\(\) ]{9,}\d/';
    return preg_match($pattern, $phoneNumber);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formData = $_POST;

    $name = $formData['name'];
    if (empty($name)) {
        http_response_code(400);
        exit();
    }

    $phoneNumber = $formData['phone'];
    if (!validatePhoneNumber($phoneNumber)) {
        http_response_code(400);
        exit();

    //Проверяет наличие пары телефон+имя в списке отправленных
    $csvFile = 'data.csv'; 
    if (($handle = fopen($csvFile, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($data[0] === $name && $data[1] === $phoneNumber) {
                http_response_code(400);
                echo json_encode(array('error' => 'This pair already exists'));
                exit();
            }
        }
        fclose($handle);
    }

    //Добавляет несуществующую пару
    if (($handle = fopen($csvFile, "a")) !== FALSE) {
        fputcsv($handle, array($name, $phoneNumber));
        fclose($handle);
    }

    $sendData = [
        'stream_code' => 'iu244',
        'client' => [
            'name' => $formData['name'],
            'phone'  => $formData['phone'],
        ],
        'sub1' => $formData['test'],
    ];
    $jsonData = json_encode($sendData);

    $curl = curl_init(API_URL);

    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer     NWJLZGEWOWETNTGZMS00MZK4LWFIZJUTNJVMOTG0NJQXOTI3',
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        $error = curl_error($curl);
        echo json_encode(array('error' => 'Ошибка отправки реквеста: ' . $error));
    } else {
        echo $response;
    }

    curl_close($curl);
} else {
    echo json_encode(array('error' => 'Неправильный метод запроса'));
}
