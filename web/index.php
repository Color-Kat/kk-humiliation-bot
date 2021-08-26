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
                'лох',
                'лох',
                'лошара',
                'лошара',
                'лошара',
                'лошара',
                'лашпед',
                'лашпед',
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
                'пердун',
                'дед-пердун',
                'дед-пердун',
                'запердыш',
                'засерыш',
                'урод',
                'урод',
                'дурак',
                'дурак',
                'дебил',
                'дебил',
                'дебилойд',
                'уродец',
                'гад',
                'падла',
                'падла',
                'мусор',
                'тупица',
                'тупой',
                'срань',
                'срань',
                'засранец',
                'засранец',
                'свинья',
                'жертва оборта',
                'жертва оборта',
                'высер',
                'сцыкун',
                'гад ползучий',
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
                'Олег',
                'БОМЖ',
                'БОМЖара',
                'алкаш',
                'наркоман',
                'нарик',
                'торчок',
                'абобус',
                'абобус',
                'абобус',
                'даша корейка',
                // '',
            ];

            $random_insult_number = rand(0, count($insults));

            // $you = ['ты', 'вы'];
            // $request_params['message'] = $you[array_rand($you)] . ' ' . $insults[$random_insult_number];
            $request_params['message'] = 'ты' . ' ' . $insults[$random_insult_number];

            if ((stripos($data->object->body, 'да') !== false ||
                stripos($data->object->body, 'ага') !== false ||
                stripos($data->object->body, 'конечно') !== false ||
                stripos($data->object->body, 'согласен') !== false ||
                stripos($data->object->body, 'точно') !== false)) {
                $yes = [
                    'вот, то-то же',
                    'ага',
                    'конечно',
                    'я не сомневался',
                    'сто пудов',
                    'да',
                    'так точно',
                    'точно',
                    'правильно',
                    'вот',
                    'воооот',
                    'верно',
                    'я так и думал',
                    'да',
                    'ага',
                ];

                $request_params['message'] = $yes[array_rand($yes)];
            }

            // if ты or вы in message - send нет, ты
            if ((stripos($data->object->body, 'ты') !== false ||
                stripos($data->object->body, 'сам') !== false ||
                stripos($data->object->body, 'не') !== false ||
                stripos($data->object->body, 'no') !== false ||
                stripos($data->object->body, 'вы') !== false)) {

                $no_you = [
                    'нет, ты',
                    'нет, ты',
                    'нет, ты',
                    'нет, ты',
                    'кто обзывается, тот сам так называется!',
                    'сам такой',
                    'иди к черту!',
                    'иди к черту!',
                    'не обижай меня',
                    'неа)',
                    'неа)',
                    'неа)',
                    'ты-ты-ты',
                    'гыыы',
                    'нет нет нееееет',
                    'нет нет нееееет',
                ];

                $request_params['message'] = $no_you[array_rand($no_you)];
            }

            // go away
            if (
                stripos($data->object->body, 'иди ') !== false ||
                stripos($data->object->body, 'пош') !== false
            ) {
                $go_away = [
                    'сам иди',
                    'сам иди',
                    'после вас',
                    'после тебя',
                    'неа, сам иди',
                    'пошел к черту',
                    'не груби мне!',
                    'пошел нафиг',
                    'у меня нет ног(',
                    'сам иди',
                    'уходи',
                ];

                $request_params['message'] = $go_away[array_rand($go_away)];
            }

            file_get_contents('https://api.vk.com/method/messages.send?' . http_build_query($request_params));

            return 'ok';

        default:
            # code...
            break;
    }

    return 'nioh';
});

$app->run();
