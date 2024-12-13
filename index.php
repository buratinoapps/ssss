<?php
// Устанавливаем заголовки для разрешения запросов с других доменов (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Проверяем, что запрос является POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из тела запроса
    $input = json_decode(file_get_contents("php://input"), true);

    // Проверяем наличие параметра referrerId
    if (isset($input['referrerId'])) {
        $referrerId = htmlspecialchars($input['referrerId']); // Экранируем значение для безопасности

        // Формируем ответ
        $response = [
            "success" => true,
            "referrerId" => $referrerId
        ];

        // Возвращаем ответ в формате JSON
        echo json_encode($response);
    } else {
        // Ошибка: параметр отсутствует
        $response = [
            "success" => false,
            "message" => "referrerId is missing"
        ];

        // Возвращаем ошибку
        echo json_encode($response);
    }
} else {
    // Ошибка: неверный метод запроса
    $response = [
        "success" => false,
        "message" => "Invalid request method"
    ];

    // Возвращаем ошибку
    echo json_encode($response);
}
