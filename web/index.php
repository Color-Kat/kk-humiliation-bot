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
            // create response array
            $request_params = [
                'user_id' => $data->object->user_id,
                'message' => 'лошара',
                'access_token' => getenv('VK_TOKEN'),
                'v' => '5.80'
            ];

            // insults list
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
                'животина',
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
                'скот',
                'палено',
                'бревно',
                'пень',
                'обосрался',
                'обосрался',
                'обоссался',
                'в говне',
                'в моче',
                'негр',
                'нигер',
                'барыга?',
                'очкобус',
                'страшный',
                'очконавт',
                'старпер',
                'баба',
                'Люся',
                'больной',
                'псих',
                'быдло',
                'стырик',
                'нищий',
                'слабак',
                'черт',
                'чертила',
                'чертище',
                'ЧЕРТопоЛОХ',
                'черт',
                'черный черт',
                'кобан',
                'свин',
                '',
                '',
                '',
                '',
            ];

            // send random insult
            $random_insult_number = rand(0, count($insults));

            // $you = ['ты', 'вы'];
            // $request_params['message'] = $you[array_rand($you)] . ' ' . $insults[$random_insult_number];
            $request_params['message'] = 'ты' . ' ' . $insults[$random_insult_number];

            // if user say yes
            if ((mb_stripos($data->object->body, 'да') !== false ||
                mb_stripos($data->object->body, 'ага') !== false ||
                mb_stripos($data->object->body, 'конечно') !== false ||
                mb_stripos($data->object->body, 'согласен') !== false ||
                mb_stripos($data->object->body, 'точно') !== false)) {
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

            // if user say "you" - send "no, you"
            if ((mb_stripos($data->object->body, 'ты') !== false ||
                mb_stripos($data->object->body, 'сам') !== false ||
                mb_stripos($data->object->body, 'не') !== false ||
                mb_stripos($data->object->body, 'no') !== false ||
                mb_stripos($data->object->body, 'пид') !== false ||
                mb_stripos($data->object->body, 'сук') !== false ||
                mb_stripos($data->object->body, 'лош') !== false ||
                mb_stripos($data->object->body, 'лох') !== false ||
                mb_stripos($data->object->body, 'дебил') !== false ||
                mb_stripos($data->object->body, 'идиот') !== false ||
                mb_stripos($data->object->body, 'скот') !== false ||
                mb_stripos($data->object->body, 'скат') !== false ||
                mb_stripos($data->object->body, 'уе') !== false ||
                mb_stripos($data->object->body, 'вы') !== false)) {

                $no_you = [
                    'нет, ты',
                    'нет, ты',
                    'нет',
                    'нет',
                    'нет -_-',
                    'нет -_-',
                    'нет, ты',
                    'нет, ты',
                    'иди нафиг',
                    'иди в зад',
                    'иди в баню',
                    'кто обзывается, тот сам так называется!',
                    'иди к черту!',
                    'иди к черту!',
                    'не обижай меня',
                    'неа)',
                    'неа)',
                    'неа)',
                    'ты-ты-ты',
                    'я так сказал!',
                    'я так сказал',
                    'я так сказал!',
                    'я так сказал, понял?',
                    'я так сказал, понял!?',
                    'гыыы',
                    'нет нет нееееет',
                    'нет нет нееееет',
                ];

                $request_params['message'] = $no_you[array_rand($no_you)];
            }

            // go away
            if (
                mb_stripos($data->object->body, 'иди ') !== false ||
                mb_stripos($data->object->body, 'пош') !== false
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

            if (
                strlen($data->object->body) > 99
            ) {
                $shut_up = [
                    'заткнись',
                    'замолчи',
                    'умолкни',
                    'рот закрой',
                    'задолбал',
                    'иди к черту',
                    'молааать!',
                    'заткнись',
                    'умолкни',
                    'не пиши мне',
                    'заткнись и не объясняй мне ничего, я бот!',
                    'молчать!',
                    'заткнись',
                    'иди к черту!',
                    'задолбал!',
                ];

                $request_params['message'] = $shut_up[array_rand($shut_up)];
            }

            // user says insults himself
            if (
                array_intersect(explode(' ', $data->object->body), $insults)
            ) {
                $it_is_you = [
                    'сам такой',
                    'сам такой',
                    'сам',
                    'нет, ты',
                    'нет, ты',
                    'нет',
                    'неа)',
                    'не обзывайся!',
                    'кто обзывается. тот сам так называется!',
                ];

                $request_params['message'] = $it_is_you[array_rand($it_is_you)];
            }

            // no is gay's answer
            if (
                mb_stripos($data->object->body, 'дора ответ') !== false ||
                mb_stripos($data->object->body, 'гея ответ') !== false
            ) {
                $request_params['message'] = 'гея аргумент';
            }
            if (
                mb_stripos($data->object->body, 'дор обнаружен') !== false ||
                mb_stripos($data->object->body, 'гей обнаружен') !== false ||
                // for written errors
                mb_stripos($data->object->body, 'дор обноружен') !== false ||
                mb_stripos($data->object->body, 'гей обноружен') !== false
            ) {
                $request_params['message'] = 'я засекречен, твой анал не вечен)';
            }

            // yes - end of ...
            if (
                mb_stripos($data->object->body, 'головка от') !== false
            ) {
                $end_of = [
                    'а ты ее края)',
                    'фамилия твоя',
                    'сейчас окажется у тебя',
                ];

                $request_params['message'] = $end_of[array_rand($end_of)];
            }

            if (
                mb_stripos($data->object->body, 'пиз') !== false
            ) {

                $request_params['message'] = 'остроумно';
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
