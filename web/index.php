<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => 'php://stderr',
));
$app->get('/', function () use ($app) {
    return 'heroku is the bad hosting';
});

$app->post('/bot', function () use ($app) {
    $data = json_decode(file_get_contents('php://input'));

    if (!$data) return 'nioh';

    if (
        $data->secret !== getenv('VK_SECRET_TOKEN') &&
        $data->type !== 'confirmation'
    ) return 'nioh';

    switch ($data->type) {
        case 'confirmation':
            return getenv('VK_CONFIRMATION_CODE');

        case 'message_new':

            $request_params = [
                'user_id' => $data->object->user_id,
                'message' => 'лошара',
                'access_token' => getenv('VK_TOKEN'),
                'v' => '5.80'
            ];

            $insults = [
                'лох',
                'лошара',
                'лашпед',
                'петух',
                'петушара',
                'петя',
                'собака',
                'животное',
                'живатина',
                'скотина',
                'леший',
                'дед',
                'пердун',
                'дед-пердун',
                'запердыш',
                'засерыш',
                'урод',
                'дурак',
                'дебил',
                'дебилойд',
                'уродец',
                'гад',
                'падла',
                'мусор',
                'тупица',
                'тупой',
                'срань',
                'засранец',
                'свинья',
                'жертва оборта',
                'высер',
                'сцыкун',
                'гад ползучий',
                'скупердяй',
                'жадоба',
                'алочный',
                'тупой',
                'глупый',
                'идиот',
                'даун',
                'гей',
                'трансгендер',
                'фашист',
                'ОЛЕГ',
                'перфаратор',
                'паразит',
                'предатель',
                'горе',
                '',
                '',
                '',
                '',
            ];

            $random_insult_number = rand(0, count($insults));

            $request_params['message'] = array_rand([
                'ты',
                'вы'
            ]) . ' ' . $insults[$random_insult_number];


            // if ты or вы in message - send нет, ты
            if ((stripos($data->object->body, 'ты') !== false ||
                stripos($data->object->body, 'сам') !== false ||
                stripos($data->object->body, 'не') !== false ||
                stripos($data->object->body, 'no') !== false ||
                stripos($data->object->body, 'иди') !== false ||
                stripos($data->object->body, 'вы') !== false))
                $request_params['message'] = array_rand([
                    'нет, ты',
                    'кто обзывается, тот сам так называется!',
                    'сам такой',
                    'иди к черту!',
                    'не обижай меня',
                    'неа)',
                    'ты-тыт-тыты-тыт-ыты-тыт-ыты-ыт',
                    'гыыы',
                    'нет, вы',
                    'нет нет нееееет',
                    'noo',
                    'nope',
                ]);

            if ((stripos($data->object->body, 'да') !== false ||
                stripos($data->object->body, 'ага') !== false ||
                stripos($data->object->body, 'конечно') !== false ||
                stripos($data->object->body, 'согласен') !== false ||
                stripos($data->object->body, 'точно') !== false))
                $request_params['message'] = array_rand([
                    'вот, то-то же',
                    'ага',
                    'конечно',
                    'я не сомневался',
                    'сто пудов',
                    'да',
                    'так точно',
                    'правильно',
                    'вот',
                    'воооот',
                    'верно',
                    'я так и думал',
                    'да',
                    'ага',
                ]);

            file_get_contents('https://api.vk.com/method/messages.send?' . http_build_query($request_params));

            return 'ok';

        default:
            # code...
            break;
    }

    return 'nioh';
});

$app->run();
