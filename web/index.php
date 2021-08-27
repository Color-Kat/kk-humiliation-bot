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
                'лошара',
                'лошара',
                'лашпед',
                'лашпед',
                'петух',
                'петушара',
                'петя',
                'собака',
                'хохол',
                'животное',
                'животина',
                'скотина',
                'леший',
                'дед',
                'пердун',
                'пердун',
                'дед-пердун',
                'запердыш',
                'засерыш',
                'урод',
                'урод',
                'дурак',
                'дурак',
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
                'даша корейка',
                'скот',
                'палено',
                'бревно',
                'пень',
                'обосрался',
                'обосрался',
                'в говне',
                'в моче',
                'сусыня',
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
                'тварь',
                'тварина',
                'слабак',
                'черт',
                'чертила',
                'чертище',
                'ЧЕРТопоЛОХ',
                'черт',
                'черный черт',
                'кобан',
                'хулиган',
                'свин',
                'обезьяна',
                'макака',
                'шимпанзе',
                'абориген',
                'ушлепок',
                'тапок',
                'тумбочка прикроватная',
                'разве не дурак?',
                'разве не скотина?',
                'разве не болен?',
                'болен! Вернись в палату',
                'в палату вернись-то',
                'с палаты сбежал?',
                'говно',
                'крыса',
                'крысёныш',
                'какашка'
            ];

            // send random insult
            $random_insult_number = rand(0, count($insults));
            $request_params['message'] = 'ты' . ' ' . $insults[$random_insult_number];

            // ========= YES YES YES ========= //
            // if user say yes
            if ((mb_stripos($data->object->body, 'да') !== false ||
                mb_stripos($data->object->body, 'ага') !== false ||
                mb_stripos($data->object->body, 'хорошо') !== false ||
                mb_stripos($data->object->body, 'харашо') !== false ||
                mb_stripos($data->object->body, 'харошо') !== false ||
                mb_stripos($data->object->body, 'хорашо') !== false ||
                mb_stripos($data->object->body, 'коне') !== false ||
                mb_stripos($data->object->body, 'конэ') !== false ||
                mb_stripos($data->object->body, 'ок') !== false ||
                mb_stripos($data->object->body, 'конечно') !== false ||
                mb_stripos($data->object->body, 'согласен') !== false ||
                mb_stripos($data->object->body, 'точно') !== false)) {
                $yes = [
                    'вот, то-то же',
                    'ага',
                    'конечно',
                    'я не сомневался',
                    'сто пудов',
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

            // ========= YOU OR INSULTS ======== //
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
                    'нет',
                    'нет -_-',
                    'нет, ты',
                    'иди нафиг',
                    'иди в зад',
                    'иди в баню',
                    'кто обзывается, тот сам так называется!',
                    'иди к черту!',
                    'не обижай меня',
                    'неа)',
                    'ты-ты-ты',
                    'гыыы',
                    'нет нет нееееет',
                    'выкуси',
                    'язык свой прикуси, ' . $insults[$random_insult_number],
                ];

                $request_params['message'] = $no_you[array_rand($no_you)];
            }

            // ========= GO AWAY ========= //
            // go away
            if (
                mb_stripos($data->object->body, 'иди ') !== false ||
                mb_stripos($data->object->body, 'пош') !== false
            ) {
                $go_away = [
                    'сам иди',
                    'после тебя',
                    'неа, сам иди',
                    'пошел к черту',
                    'не груби мне!',
                    'пошел нафиг',
                    'пошел к черту',
                    'у меня нет ног(',
                    'у меня нет ног( Снеси меня сам',
                    'сам иди',
                ];

                $request_params['message'] = $go_away[array_rand($go_away)];
            }

            // ======== LONG TEXT ========= //
            if (
                strlen($data->object->body) > 99
            ) {
                $shut_up = [
                    'заткнись',
                    'замолчи',
                    'умолкни',
                    'рот закрой',
                    'задолбал',
                    'молааать!',
                    'заткнись',
                    'умолкни',
                    'не пиши мне',
                    'заткнись и не объясняй мне ничего, я бот!',
                    'не устал писать-то?',
                    'не устал писать еще?',
                ];

                $request_params['message'] = $shut_up[array_rand($shut_up)];
            }

            // ========= SAY INSULTS HIMSELF ========= //
            // user says insults himself
            if (
                array_intersect(explode(' ', $data->object->body), $insults)
            ) {
                $it_is_you = [
                    'сам такой',
                    'сам',
                    'нет, ты',
                    'нет',
                    'неа)',
                    'не обзывайся!',
                    'кто обзывается. тот сам так называется!',
                ];

                $request_params['message'] = $it_is_you[array_rand($it_is_you)];
            }

            // === NO IS GAY"S ANSWER === //
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

            // HI HELLO GOOD DAY
            if (
                mb_stripos($data->object->body, 'прив') !== false ||
                mb_stripos($data->object->body, 'ку') !== false ||
                mb_stripos($data->object->body, 'здравс') !== false ||
                mb_stripos($data->object->body, 'здрас') !== false ||
                mb_stripos($data->object->body, 'алло') !== false ||
                mb_stripos($data->object->body, 'аллё') !== false ||
                mb_stripos($data->object->body, 'здаро') !== false ||
                mb_stripos($data->object->body, 'добрый') !== false ||
                mb_stripos($data->object->body, 'здоро') !== false ||
                mb_stripos($data->object->body, 'здрави') !== false
            ) {
                $hi = [
                    'и тебе привет, ' . $insults[$random_insult_number],
                    'здраствуй, ' . $insults[$random_insult_number],
                    'иди к черту, ' . $insults[$random_insult_number],
                    'я тебя ненавижу!',
                    'ты испортил мне весь день(',
                    'ты кто такой? иди к черту, я тебя не звал!',
                    'ты кто такой? иди нафиг, я тебя не звал!',
                    'хто я?',
                    'хулиган!',
                    'вот дебилов развелось. На каждом шагу уже!',
                    'вот петухов развелось. На каждом шагу уже!',
                    'вот уродов развелось. На каждом шагу уже!',
                    'плати налоги',
                    'я Григорий, пошел нахрен!',
                    'я Григорий, пошел в баню!',
                    'я Гриша, а ты ' . $insults[$random_insult_number],
                    'я Гриша. Гриша хороший, а ты ' . $insults[$random_insult_number],
                ];

                $request_params['message'] = $hi[array_rand($hi)];
            }

            // ===== STICKERS AND  ===== // 
            if (strlen($data->object->body) == 0) {
                $please_writte = [
                    // 'и тебе привет, ' . $insults[$random_insult_number],
                    'текстом пиши, руки не отвалятся!',
                    'слыш, ' . $insults[$random_insult_number] . ', написать сложно?!',
                    'эй, ' . $insults[$random_insult_number] . ', печатать лень?!',
                    'ну ты и дурак, сообщение напиши',
                    'печатать разучился, ' . $insults[$random_insult_number] . '?',
                    'а напечатать уже лень?',
                    'печатать умеешь? Так печатай, ' . $insults[$random_insult_number],
                    'Гриша не понимает, напиши сообщение, ' . $insults[$random_insult_number],
                    'Гриша не понимает, напиши сообщение, тварь',
                ];

                $request_params['message'] = $please_writte[array_rand($please_writte)];
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
