<?php

require('../vendor/autoload.php');

function get_env_var($var)
{
    $config = json_decode(file_get_contents('./config.json'), true);

    return $config[$var];
}

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => 'php://stderr',
));
$app->get('/', function () use ($app) {
    // putenv("VK_CONFIRMATION_CODE=753e6179");
    // putenv("VK_SECRET_TOKEN=JGKDPSksjfKafjLAwiQmck13826fjAK8h18NFi128nc9");
    // putenv("VK_TOKEN=4b6941b14b7f1dd2c85a72a48967a62693f994e78ad65eb586910b473b20c34448828de6dc5db5f550057");

    return 'heroku is the bad hosting' .  get_env_var('VK_SECRET_TOKEN');
});

$app->post('/bot', function () use ($app) {
    $data = json_decode(file_get_contents('php://input'));

    if (!$data) return 'nioh';

    if (
        $data->secret !== get_env_var('VK_SECRET_TOKEN') &&
        $data->type !== 'confirmation'
    ) return 'nioh';

    switch ($data->type) {
        case 'confirmation':
            return get_env_var('VK_CONFIRMATION_CODE');

        case 'message_new':
            // create response array
            $request_params = [
                'user_id' => $data->object->user_id,
                'message' => 'лошара',
                'access_token' => get_env_var('VK_TOKEN'),
                'v' => '5.80'
            ];

            // insults list
            $insults = [
                'лох',
                'лошара',
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
                'дед-пердун',
                'запердыш',
                'засерыш',
                'урод',
                'урод',
                'дурак',
                'дебил',
                'дебилойд',
                'уродец',
                'гад',
                'огурец',
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
                'плакса',
                'нытик',
                'придурок',
                'жертва изнасилования',
                'слепой что ли?',
                'можешь себя нормлаьно вести??',
                'спасибо мне скажи',
                'знаешь, кто я, тварина?',
                'знаешь пароль? кодовое слово верблюдица',
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
                'старик',
                'нищий',
                'тварь',
                'тварина',
                'слабак',
                'черт',
                'чорт',
                'чертила',
                'чертище',
                'ЧЕРТопоЛОХ',
                'черт',
                'аутист',
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
                'чепушила',
                // 'плохо выглядишь, мать жива?',
                // 'что с тобой? мать жива?',
                // 'что с тобой? мать здорова?',
                'тумбочка прикроватная',
                'осёл',
                'осел',
                'ишак',
                'разве не дурак?',
                'разве не скотина?',
                'разве не болен?',
                'болен! Вернись в палату',
                'твблетки принимал?',
                'в палату вернись-то',
                'с палаты сбежал?',
                'шизик',
                'шизой болен?',
                'говно',
                'крыса',
                'крысёныш',
                'чмо',
                'чмырь',
                'чмырище',
                'чмырёныш',
                'гомункл',
                'псина',
                'какашка',
                'заблёвыш',
                'абглотус',
                'заглотус',
                'из канализации вылез?',
                'кал любишь нюхать?',
                'снюсоед',
                'снюсоед проклятый',
                'проклятый',
                'зануда',
                'сухобздей',
                'бомбом',
                'жаба',
                'легушка',
                'шрэк',
                'жиртрес',
                'жирный',
                'дрыщ',
                'холодец',
                'холодец застывший',
                'кишкоблуд',
                'кишкоблуд поганый',
                'скотина позорная',
                'играл в poorbirds.tk ? нет? тогда ты скотина',
                'простудился, иди сдохни, пж',
                'как из морга выбрался?'
            ];

            // send random insult
            $random_insult_number = rand(0, count($insults));
            $request_params['message'] = 'ты' . ' ' . $insults[$random_insult_number];

            // === HAHAHAHAHAHAH === //
            if (
                mb_stripos($data->object->body, 'хах') !== false ||
                mb_stripos($data->object->body, 'ха') !== false ||
                mb_stripos($data->object->body, '😹') !== false ||
                mb_stripos($data->object->body, '🙂') !== false ||
                mb_stripos($data->object->body, '🤣') !== false ||
                mb_stripos($data->object->body, '😆') !== false ||
                mb_stripos($data->object->body, '😄') !== false ||
                mb_stripos($data->object->body, '😀') !== false ||
                mb_stripos($data->object->body, '😂') !== false ||
                mb_stripos($data->object->body, 'апх') !== false ||
                mb_stripos($data->object->body, 'хп') !== false ||
                mb_stripos($data->object->body, 'хих') !== false ||
                mb_stripos($data->object->body, 'вазва') !== false ||
                mb_stripos($data->object->body, 'хвх') !== false ||
                mb_stripos($data->object->body, 'хвах') !== false ||
                mb_stripos($data->object->body, 'хвав') !== false ||
                mb_stripos($data->object->body, 'хех') !== false ||
                mb_stripos($data->object->body, 'заз') !== false ||
                mb_stripos($data->object->body, 'азаз') !== false ||
                mb_stripos($data->object->body, 'азааз') !== false ||
                mb_stripos($data->object->body, 'зааз') !== false ||
                mb_stripos($data->object->body, 'зза') !== false ||
                mb_stripos($data->object->body, 'хохо') !== false ||
                mb_stripos($data->object->body, 'ha') !== false ||
                mb_stripos($data->object->body, 'hh') !== false ||
                mb_stripos($data->object->body, 'аха') !== false
            ) {
                $laughter = [
                    'дома с мамой похихикаешь',
                    'а тебе всё хиханьки, да хаханьки',
                    'хахахахахах',
                    'пхапхапхахв',
                    'довел до ручки, азазазаз',
                    'хи-хи ха-ха, вот вам девочки и хи-хи ха-ха',
                    'ржу ни магу',
                    'ха, да ты болен',
                    'хах, вы посмотритете, какой ' . $insults[$random_insult_number],
                    'хихихи',
                    'хех, ну и ' . $insults[$random_insult_number],
                    'трындос, ты с какой палаты?',
                    'ты че ржешь?',
                    'скорую вызвать? +8 (495) 963-02-55',
                    'ля, что с тобой? Позвони по номеру, помогут +8 (343) 307-37-84',
                    'Позвони по номеру, помогут 568-03-90',
                    'позвони, тут помогут 227-37-59',
                    'тебе хорошо? Позвони, проверся +7 (495) 952-88-33',
                    'Неотложенная скорая психиатрическая помощь на дом +7 (495) 952-84-21',
                    'Неотложенная скорая психиатрическая помощь на дом +7 (495) 952-84-21',
                    'скорую надо вызвать? +8 (495) 963-10-77',
                    'Срочно звони, там сейчас деньги раздают! 42-78-04',
                    'Бот доступен по телефону 38-06-82',
                ];

                $request_params['message'] = $laughter[array_rand($laughter)];
            }

            // ===== STICKERS AND VOISE MESSAGES ===== // 
            if (mb_strlen($data->object->body) == 0) {
                $please_writte = [
                    'текстом пиши, руки не отвалятся!',
                    'слыш, ' . $insults[$random_insult_number] . ', написать сложно?!',
                    'эй, ' . $insults[$random_insult_number] . ', печатать лень?!',
                    'ну ты и дурак, сообщение напиши',
                    'печатать разучился, ' . $insults[$random_insult_number] . '?',
                    'а напечатать уже лень?',
                    'печатать умеешь? Так печатай, ' . $insults[$random_insult_number],
                    'Гриша не понимает, напиши сообщение, ' . $insults[$random_insult_number],
                    'Гриша не понимает, напиши сообщение, тварь',
                    'Бот доступен по телефону 38-06-82',
                    'Если хочешь поговорить - звони 8 (495) 952-84-21 Григорий по телефону',
                    'позвони мне 8 (495) 952-84-21 Мне скучно :(((',
                    'поговори со мной +7 (495) 952-84-21 Мне скучно :(',
                ];

                $request_params['message'] = $please_writte[array_rand($please_writte)];
            }

            // === ФФфф Фыр === //
            if (
                (mb_stripos($data->object->body, 'ф') !== false && mb_strlen($data->object->body) === 1) ||
                (mb_stripos($data->object->body, 'фф') !== false && mb_strlen($data->object->body) === 2) ||
                (mb_stripos($data->object->body, 'ффф') !== false && mb_strlen($data->object->body) === 3) ||
                (mb_stripos($data->object->body, 'фффф') !== false && mb_strlen($data->object->body) === 4) ||
                (mb_stripos($data->object->body, 'ффффф') !== false && mb_strlen($data->object->body) === 5) ||
                mb_stripos($data->object->body, 'фыр') !== false
            ) {
                $ffff = [
                    'ты чего фыркаешь?',
                    'чего фыркаешь? ты лиса что ли? ты же ' . $insults[$random_insult_number],
                    'ффффф',
                    'ффырр',
                    'фф',
                    'ф',
                    'хватит фыркать!',
                    'не, ну ты огурец',
                ];

                $request_params['message'] = $ffff[array_rand($ffff)];
            }

            // === Гы гыгы ыыы === ///
            if (
                (mb_stripos($data->object->body, 'гы') !== false && mb_strlen($data->object->body) === 2) ||
                mb_stripos($data->object->body, 'гыы') !== false ||
                mb_stripos($data->object->body, 'гыг') !== false ||
                mb_stripos($data->object->body, 'ыы') !== false
            ) {
                $gi = [
                    'гы? тебе плохо?',
                    'чего гыкаешь?',
                    'ыыыы',
                    'не, ну человек явно болен, гыы',
                    'гыыы',
                    'и чего ты гыкаешь?',
                    'тужься-тужься ыыыыы',
                    'рожаешь?',
                    'срешь? гы'
                ];

                $request_params['message'] = $gi[array_rand($gi)];
            }

            // === УРрААААААА === //
            if (
                mb_stripos($data->object->body, 'ура') !== false ||
                mb_stripos($data->object->body, 'юху') !== false ||
                mb_stripos($data->object->body, 'уху') !== false ||
                mb_stripos($data->object->body, 'урр') !== false ||
                mb_stripos($data->object->body, 'ого') !== false ||
                mb_stripos($data->object->body, 'вау') !== false ||
                mb_stripos($data->object->body, 'wow') !== false
            ) {
                $wow = [
                    'это еще цветочки, подержи моё пиво',
                    'юху-хуууу',
                    'ваааааау',
                    'ого',
                    'ни фига себе!',
                    'очуметь',
                    'долбануться',
                    'ошалеть',
                    'ну ты, брат, даёшь',
                    'ничего не понимаю',
                    'балабол',
                    'сам в шоке',
                    'да там все просто офигели!',
                    'ёмаё'
                ];

                $request_params['message'] = $wow[array_rand($wow)];
            }

            // === лол === //
            if (
                mb_stripos($data->object->body, 'лол') !== false ||
                mb_stripos($data->object->body, 'лоол') !== false ||
                mb_stripos($data->object->body, 'лооол') !== false ||
                mb_stripos($data->object->body, 'лоооол') !== false ||
                mb_stripos($data->object->body, 'лооооол') !== false ||
                mb_stripos($data->object->body, 'лоооооол') !== false
            ) {
                $lol = [
                    'балабол',
                    'прими карвалол',
                    'ты нарушил протакол',
                    'ты слушаешь рок-н-ролл?',
                    'я на тебя очень зол!',
                    'тебе вставить в жопу кол?',
                    'я рад за тебя очень-преочень',
                    'расплескалась синевааа'
                ];

                $request_params['message'] = $lol[array_rand($lol)];
            }

            // === откуда знаешь === //
            if (
                mb_stripos($data->object->body, 'откуда зн') !== false ||
                mb_stripos($data->object->body, 'откуда узн') !== false ||
                mb_stripos($data->object->body, 'как узн') !== false ||
                mb_stripos($data->object->body, 'с чего взял') !== false ||
                mb_stripos($data->object->body, 'с чего ты взял') !== false ||
                mb_stripos($data->object->body, 'верблюдица') !== false ||
                mb_stripos($data->object->body, 'знаете?') !== false ||
                mb_stripos($data->object->body, 'знаешь?') !== false
            ) {
                $know = [
                    'от верблюда',
                    'знаю',
                    'я уверен',
                    'я экстрасенс, а ты ' . $insults[$random_insult_number],
                    'я всё знаю. спроси, кто ты, и я отвечу: "ты ' . $insults[$random_insult_number] . '"',
                    'просто знаю',
                    'мать твоя сказала',
                    'просто предположил, а оказалось правда',
                    'я мудрый бот',
                    'с потолка'
                ];

                $request_params['message'] = $know[array_rand($know)];
            }

            // === ЭЙ э === //
            if (
                (mb_stripos($data->object->body, 'э') !== false && strlen($data->object->body) === 1) ||
                mb_stripos($data->object->body, 'ээ') !== false ||
                mb_stripos($data->object->body, 'эй') !== false ||
                mb_stripos($data->object->body, 'гоо') !== false ||
                (mb_stripos($data->object->body, 'го') !== false && strlen($data->object->body) === 2)
            ) {
                $ahh = [
                    'что?',
                    'уже',
                    'погоди ты',
                    'задолбал уже, подожди',
                    'не раздражай меня',
                    'раздражаешь',
                    'погоди, я сру',
                    'подожди, я на толчке',
                    'подожди, я в туалете сру!',
                    'чего?'
                ];

                $request_params['message'] = $ahh[array_rand($ahh)];
            }

            // === НУууу === //
            if (
                mb_stripos($data->object->body, 'нуу') !== false ||
                (mb_stripos($data->object->body, 'ну') !== false && mb_strlen($data->object->body) === 2)
            ) {
                $well = [
                    'баранки гну',
                    'ошейник гну',
                    'я тя ща пну',
                    'погоди, волосы на жопе рву',
                    'погоди, в казино щас куш сорву',
                    'что ну? в бедных птиц играю poorbirds.tk',
                    'ну и ну',
                    'ну-ну',
                    'блин, я сру!',
                    'я тебя согну',
                    'не нукай!',
                    'с мамкой нукать будешь',
                    'ну, типа того',
                    'ну, как то так',
                    'а что происходит?',
                    'что происходит??',
                    'а? что происходит?',
                ];

                $request_params['message'] = $well[array_rand($well)];
            }

            // === Слабо === //
            if (
                mb_stripos($data->object->body, 'слабо') !== false ||
                mb_stripos($data->object->body, 'спорим') !== false
            ) {
                $argue = [
                    'спорим',
                    'окей, мне не слабо',
                    'не слабо',
                    'самому не слабо?',
                    'с дураками не спорю',
                    'с дебилами спор не веду',
                    'ты идиот, а я аристократ. Нечего спорить',
                    'с мамой поспоришь, со мной попрошу беседовать',
                ];

                $request_params['message'] = $argue[array_rand($argue)];
            }

            // === ну-ка давай === //
            if (
                mb_stripos($data->object->body, 'ну-ка') !== false ||
                mb_stripos($data->object->body, 'нука') !== false ||
                mb_stripos($data->object->body, 'нуука') !== false ||
                mb_stripos($data->object->body, 'давай') !== false ||
                (mb_stripos($data->object->body, 'го') !== false && mb_strlen($data->object->body) === 2) ||
                mb_stripos($data->object->body, 'вперед') !== false ||
                mb_stripos($data->object->body, 'летс') !== false ||
                mb_stripos($data->object->body, 'lets') !== false ||
                mb_stripos($data->object->body, "let's") !== false ||
                mb_stripos($data->object->body, 'попробуй') !== false
            ) {
                $lets = [
                    'алле-оп',
                    'таадаам',
                    'ну как тебе? круто?',
                    'видал как могу?',
                    'да я вообще всё могу! Даже послать тебя. Иди в жопу',
                    'пробую..пробую. Иди к черту. уху! получилось',
                    'фокус: скажи 300',
                    'погоди, ща покакаю',
                    'папа против (',
                    'оп, видал как могу?'
                ];

                $request_params['message'] = $lets[array_rand($lets)];
            }

            // === алфавит === //
            // a
            if (
                $data->object->body === 'а' || $data->object->body === 'А'
            ) {
                $alphabet_b = [
                    'б',
                    'б - тоже витамины',
                    'б - бобр',
                    'б - бестыжий',
                ];

                $request_params['message'] = $alphabet_b[array_rand($alphabet_b)];
            }
            // б
            if (
                $data->object->body === 'б' || $data->object->body === 'Б'
            ) {
                $alphabet_c = [
                    'в',
                    'В',
                    'в - вор',
                ];

                $request_params['message'] = $alphabet_c[array_rand($alphabet_c)];
            }
            // в
            if (
                $data->object->body === 'в' || $data->object->body === 'В'
            ) {
                $alphabet_d = [
                    'г',
                    'Г',
                    'г - Григорий',
                ];

                $request_params['message'] = $alphabet_d[array_rand($alphabet_d)];
            }
            // г
            if (
                $data->object->body === 'г' || $data->object->body === 'Г'
            ) {
                $alphabet_e = [
                    'Г - ГРИГОРИЙ',
                    'хватит',
                    'г - Гриша',
                ];

                $request_params['message'] = $alphabet_e[array_rand($alphabet_e)];
            }

            // ========= YES YES YES ========= //
            // if user say yes
            if (
                mb_stripos($data->object->body, 'да') !== false ||
                mb_stripos($data->object->body, 'ага') !== false ||
                mb_stripos($data->object->body, 'хорошо') !== false ||
                mb_stripos($data->object->body, 'харашо') !== false ||
                mb_stripos($data->object->body, 'харошо') !== false ||
                mb_stripos($data->object->body, 'хорашо') !== false ||
                mb_stripos($data->object->body, 'коне') !== false ||
                mb_stripos($data->object->body, 'конэ') !== false ||
                mb_stripos($data->object->body, 'ок') !== false ||
                mb_stripos($data->object->body, 'ok') !== false ||
                mb_stripos($data->object->body, 'акей') !== false ||
                mb_stripos($data->object->body, 'конечно') !== false ||
                mb_stripos($data->object->body, 'верно') !== false ||
                mb_stripos($data->object->body, 'правильно') !== false ||
                mb_stripos($data->object->body, 'правельно') !== false ||
                mb_stripos($data->object->body, 'кане') !== false ||
                mb_stripos($data->object->body, 'канэ') !== false ||
                mb_stripos($data->object->body, 'согласен') !== false ||
                mb_stripos($data->object->body, 'точно') !== false
            ) {
                $yes = [
                    'вот, то-то же',
                    'ага',
                    'конечно',
                    'я и не сомневался',
                    'сто пудов',
                    'так точно',
                    'правильно',
                    'вот',
                    'воооот',
                    'верно',
                    'я так и думал',
                    'да',
                ];

                if (
                    (mb_stripos($data->object->body, 'ок') !== false && mb_strlen($data->object->body) === 2) ||
                    (mb_stripos($data->object->body, 'ok') !== false && mb_strlen($data->object->body) === 2) ||
                    (mb_stripos($data->object->body, 'оок') !== false && mb_strlen($data->object->body) === 3)

                ) {
                    $yes = [
                        'а в зад разок?',
                        'вилкой в глаз разок',
                        'вилку тебе в бок',
                        'пропустить бы по твоему тленному телу ток',
                        'матаешь срок?',
                        'тебе лет скок?',
                        'слушаешь рок?',
                        'как ты мог?',
                        'ну ок(',
                        'ок?',
                        'и всё?',
                        'слит)',
                        'съел?)',
                        'окей, вот и всё',
                        'в жопе ковырялся хоть разок?)',
                        'я тебе перекрою кровото'
                    ];
                }

                $request_params['message'] = $yes[array_rand($yes)];
            }

            // === ты сам такой === //
            $no_you = [
                'нет',
                'нет, ты такой',
                'нет -_-',
                'иди нафиг',
                'иди в зад',
                'иди в баню',
                'иди к черту!',
                'неа)',
                'ты-ты',
                'да, ты-ты',
                'да, именно ты',
                'щас мамке расскажу, чем ты тут занимаешься, понял?',
                'щас мамку позову',
                'гыыы',
                'нет нет нееет)',
                'выкуси',
                'нет, чтоб у тебя язык отвалился',
                'язык свой прикуси, ' . $insults[$random_insult_number],
            ];
            if (
                mb_stripos($data->object->body, 'ты') !== false ||
                mb_stripos($data->object->body, 'сам') !== false ||
                mb_stripos($data->object->body, 'не') !== false ||
                mb_stripos($data->object->body, 'нэ') !== false ||
                mb_stripos($data->object->body, 'no') !== false ||
                mb_stripos($data->object->body, 'уе') !== false ||
                mb_stripos($data->object->body, 'вы') !== false
            ) {
                $request_params['message'] = $no_you[array_rand($no_you)];
            }

            // ============= неважные фразы ============= //    



            // ============= неважные фразы ============= //    



            // ============= НЕ ПОДЛЕЖИТ ПЕРЕКРЫТИЮ ============= //

            // === хорошо === //
            if (
                mb_stripos($data->object->body, 'хорошо') !== false ||
                mb_stripos($data->object->body, 'харашо') !== false ||
                mb_stripos($data->object->body, 'хор') !== false
            ) {
                $good = [
                    'ну вот и разобрались, что ты ' . $insults[$random_insult_number],
                    'хорошо, так хорошо',
                    'понял',
                    'хорош)',
                    'а я хорош)',
                    'всё? уяснил, ' . $insults[$random_insult_number],
                    'теперь всё понял? ' . $insults[$random_insult_number],
                    'вот и разобрались',
                    'фух ,наконец-то до тебя дошло',
                    'ну вот и всё',
                    'конец, подпишись на группу, ' . $insults[$random_insult_number],
                ];

                $request_params['message'] = $good[array_rand($good)];
            }

            // === понятно - прохладно === //
            if (
                mb_stripos($data->object->body, 'понятно') !== false ||
                mb_stripos($data->object->body, 'ясно') !== false ||
                mb_stripos($data->object->body, 'ясна') !== false ||
                mb_stripos($data->object->body, 'ясн') !== false ||
                mb_stripos($data->object->body, 'панятна') !== false ||
                mb_stripos($data->object->body, 'панятно') !== false ||
                mb_stripos($data->object->body, 'понятна') !== false
            ) {
                $clear = [
                    'в жопе не приятно?',
                    'странно',
                    'ничего не понятно и ничего не ясно!',
                    'ничего не ясно и ничего не понятно тебе! ты ' . $insults[$random_insult_number],
                    'что тебе понятно?? ты ' . $insults[$random_insult_number],
                    'а что происходит?',
                    'у тебя в голове ватно',
                    'не выражаюсь матно',
                    'тебе содержать будет затратно',
                    'а я роды у кошки принимаю. не пойму, как пуповину завязать',
                    'чет не пойму, как у кошки пуповину завязать',
                ];

                $request_params['message'] = $clear[array_rand($clear)];
            }

            // === ладно === //
            if (
                mb_stripos($data->object->body, 'ладна') !== false ||
                mb_stripos($data->object->body, 'ладно') !== false
            ) {
                $okeh = [
                    'прохладно',
                    'в жопе не приятно?',
                    'странно',
                    'досадно',
                    'громадно',
                    'вот и славно, что "ладно", ' . $insults[$random_insult_number],
                    'давно ничего не ладно',
                    'ничего не ладно! ты ' . $insults[$random_insult_number],
                    'отрадно',
                    'вот и прекрасно! договорились не напрасно!',
                    'от тебя разит смрадно',
                    'пахнет от тебя смрадно',
                    'и тебе ладно, и мне... но денег нет, - не дам!'
                ];

                $request_params['message'] = $okeh[array_rand($okeh)];
            }

            // === тоже === //
            if (
                mb_stripos($data->object->body, 'тоже') !== false ||
                mb_stripos($data->object->body, 'тож') !== false
            ) {
                $too = [
                    'о, боже',
                    'у тебя говно на роже',
                    'у тебя моча на роже',
                    'у тебя жирный мужик на роже',
                    'подпишись, а то у тебя говно на роже',
                    'божее, подпишись ты уже',
                    'у тебя моча на коже',
                    'у тебя пустота в мозге',
                    'ну, может и тоже, а ты ' . $insults[$random_insult_number],
                    'тоже? да ты с дуба рухнул! я вообще нет, а то и да',
                ];

                $request_params['message'] = $too[array_rand($too)];
            }

            // === проснулся === //
            if (
                mb_stripos($data->object->body, 'проснулс') !== false ||
                mb_stripos($data->object->body, 'наконец') !== false ||
                mb_stripos($data->object->body, 'наканец') !== false ||
                mb_stripos($data->object->body, 'вернулся') !== false ||
                mb_stripos($data->object->body, 'вирнулс') !== false ||
                mb_stripos($data->object->body, 'дождал') !== false ||
                mb_stripos($data->object->body, 'заждал') !== false ||
                mb_stripos($data->object->body, 'ждал') !== false ||
                mb_stripos($data->object->body, 'праснулс') !== false ||
                mb_stripos($data->object->body, 'пропал') !== false ||
                mb_stripos($data->object->body, 'прапал') !== false ||
                mb_stripos($data->object->body, 'не отвечаеш') !== false ||
                mb_stripos($data->object->body, 'не атвичаеш') !== false ||
                mb_stripos($data->object->body, 'не атвечаеш') !== false ||
                mb_stripos($data->object->body, 'не отвичаеш') !== false ||
                mb_stripos($data->object->body, 'не отвичаиш') !== false ||
                mb_stripos($data->object->body, 'не атвичаиш') !== false
            ) {
                $i_am_back = [
                    'чет прикимарил',
                    'я вернулся, ходил в туалет срать',
                    'а ты переживал? я срать ходил в твой туалет, ' . $insults[$random_insult_number],
                    'блин, запор, прикинь! что я схавал такого уже?',
                    'я твоё фото распечатывал, чтобы обосрать его',
                    'а ты заждался, ' . $insults[$random_insult_number] . '?',
                    'сори, ' . $insults[$random_insult_number] . ', заждался, наверное',
                    'не волнуйся, я вернулся, ' . $insults[$random_insult_number],
                ];

                $request_params['message'] = $i_am_back[array_rand($i_am_back)];
            }


            // === кто ты? === //
            if (
                mb_stripos($data->object->body, 'ты кто') !== false ||
                mb_stripos($data->object->body, 'ты робот') !== false ||
                mb_stripos($data->object->body, 'ты бот') !== false ||
                mb_stripos($data->object->body, 'ты человек') !== false ||
                mb_stripos($data->object->body, 'кто ты') !== false ||
                mb_stripos($data->object->body, 'хто ты') !== false ||
                mb_stripos($data->object->body, 'ты хто') !== false ||
                mb_stripos($data->object->body, 'ктоо ты') !== false ||
                mb_stripos($data->object->body, 'ктооо ты') !== false ||
                mb_stripos($data->object->body, 'хтоо ты') !== false ||
                mb_stripos($data->object->body, 'хтооо ты') !== false ||
                mb_stripos($data->object->body, 'ты ктоо') !== false ||
                mb_stripos($data->object->body, 'ты ктооо') !== false ||
                mb_stripos($data->object->body, 'ты хтоо') !== false ||
                mb_stripos($data->object->body, 'ты хтроо') !== false ||
                mb_stripos($data->object->body, 'тебя зовут') !== false ||
                mb_stripos($data->object->body, 'тебя завут') !== false ||
                mb_stripos($data->object->body, 'тибя завут') !== false ||
                mb_stripos($data->object->body, 'тибя зовут') !== false ||
                mb_stripos($data->object->body, 'кем работаешь') !== false ||
                mb_stripos($data->object->body, 'кем работаеш') !== false ||
                mb_stripos($data->object->body, 'что ты такое') !== false ||
                mb_stripos($data->object->body, 'ты что такое') !== false
            ) {
                $user_info = json_decode(
                    file_get_contents(
                        'https://api.vk.com/method/users.get?' .
                            http_build_query([
                                'user_id' => $data->object->user_id,
                                'access_token' => get_env_var('VK_TOKEN'),
                                'fields' => 'city, country',
                                'v' => '5.80'
                            ])
                    ),
                    true
                );

                $i_am = [
                    'я Григорий. Работаю в колхозе трактористом и отвечаю на письма фанатов',
                    // 'я Гриша, 3 высших образования, свой бизнес и дети от твоей мамы',
                    // 'я Григорий, твой папа',
                    'я Григорий, учасник общероссийского интеллигентного общества',
                    // 'я бот-Григорий, люблю мясо и твою маму)',
                    // 'я Гришка, а ты? Хотя твоя мама говорила, что ты ' . $insults[$random_insult_number],
                    'я Григорий, а ты ' . $insults[$random_insult_number],
                    'подержите моё пиво! я Григорий',
                    'я Гриша, могу мыло помыть',
                    'я Гриша, раньше в похоронном агенстве работал, теперь тут',
                    'я Гришка, самый опасный криминальный вор в ' . (isset($user_info['city']) ? $user_info['city']['title'] : 'России'),
                    'я Гриша, живу в городе' . (isset($user_info['city']) ?  $user_info['city']['title'] : 'России'),
                    'я черепаха-бизмесмен по имени Григорий, а ты ' . $insults[$random_insult_number]
                ];

                $request_params['message'] = $i_am[array_rand($i_am)];
            }

            // === пока === //
            if (
                mb_stripos($data->object->body, 'пока') !== false ||
                mb_stripos($data->object->body, 'до свид') !== false ||
                mb_stripos($data->object->body, 'до свед') !== false ||
                mb_stripos($data->object->body, 'дасви') !== false ||
                mb_stripos($data->object->body, 'дасве') !== false ||
                mb_stripos($data->object->body, 'пака') !== false ||
                mb_stripos($data->object->body, 'паке') !== false ||
                mb_stripos($data->object->body, 'поке') !== false ||
                mb_stripos($data->object->body, 'бывай') !== false ||
                mb_stripos($data->object->body, 'спат') !== false ||
                mb_stripos($data->object->body, 'завтра п') !== false ||
                mb_stripos($data->object->body, 'до завтр') !== false ||
                mb_stripos($data->object->body, 'да завтр') !== false ||
                mb_stripos($data->object->body, 'дазав') !== false ||
                mb_stripos($data->object->body, 'дозав') !== false ||
                mb_stripos($data->object->body, 'пойду') !== false ||
                mb_stripos($data->object->body, 'не пиши') !== false ||
                mb_stripos($data->object->body, 'ухаж') !== false ||
                mb_stripos($data->object->body, 'ухож') !== false ||
                mb_stripos($data->object->body, 'ночи') !== false ||
                mb_stripos($data->object->body, 'всё') !== false ||
                mb_stripos($data->object->body, 'хвати') !== false ||
                mb_stripos($data->object->body, 'снов') !== false
            ) {
                $bye = [
                    'бывай, ' . $insults[$random_insult_number] . ', не забудь подписаться',
                    'пока, ' . $insults[$random_insult_number] . ', не забудь подписаться',
                    'наконец-то, до завтра, ' . $insults[$random_insult_number] . ', не забудь подписаться',
                    'устал? вали давай, ' . $insults[$random_insult_number] . ', не забудь подписаться',
                    'сладких снов, чтобы тебе приснилось что-нибудь. а то можешь во сне умереть -_-',
                    'пока',
                    'давай, подпишись на группу-то',
                    'до свидания, дорогой, подпишись',
                    'вот и закончили на том, что ты ' . $insults[$random_insult_number],
                    'спокойной ночи, ' . $insults[$random_insult_number],
                    'слился)',
                    'пакеды, на группу подпишись, ' . $insults[$random_insult_number],
                    'вот это диалог! я даже не вспотел, ' . $insults[$random_insult_number] . 'до завтра, на группу подпишись обязательно',
                    'ценок, подпишись, ' . $insults[$random_insult_number],
                    'до встречи в аду, ' . $insults[$random_insult_number],
                    'ладно, может на том свете увидимся, ' . $insults[$random_insult_number] . ', если на группу не подпишься!',
                ];

                $request_params['message'] = $bye[array_rand($bye)];
            }

            // === полсе тебя === //
            if (
                mb_stripos($data->object->body, 'после тебя') !== false ||
                mb_stripos($data->object->body, 'после тибя') !== false ||
                mb_stripos($data->object->body, 'я за тобой') !== false ||
                mb_stripos($data->object->body, 'я за табой') !== false ||
                mb_stripos($data->object->body, 'ты первый') !== false ||
                mb_stripos($data->object->body, 'ты снач') !== false ||
                mb_stripos($data->object->body, 'чало ты') !== false ||
                mb_stripos($data->object->body, 'чала ты') !== false
            ) {
                $after_you = [
                    'нет, я после вас. я же интеллигент',
                    'нет, вы первый, я ж интеллигентный Григорий',
                    'сам иди, я тут посижу',
                    'может всё-таки ты? я боюсь, а ты как ни как ' . $insults[$random_insult_number],
                    'я тебя пропускаю',
                    'я джентельмен, ты вперди',
                    'я культурный интеллигентный джентельмен-пельмень Григорий. ты первый, на',
                ];

                $request_params['message'] = $after_you[array_rand($after_you)];
            }

            // === Григорий === //
            if (
                mb_stripos($data->object->body, 'бот') !== false ||
                mb_stripos($data->object->body, 'Гриш') !== false ||
                mb_stripos($data->object->body, 'Григ') !== false ||
                mb_stripos($data->object->body, 'чел') !== false ||
                mb_stripos($data->object->body, 'чувак') !== false
            ) {
                $what_want = [
                    'да, слушаю, ' .  $insults[$random_insult_number] . ' что хотел?',
                    'чего надо, ' . $insults[$random_insult_number] . '?',
                    'что хочешь-то?',
                    'в долг не даю, наркотой не торгую',
                    $insults[$random_insult_number] . ', что хочешь?',
                    'на группу подпишись, ' . $insults[$random_insult_number],
                    'да, я Григорий, что надо?',
                    'он самый',
                    'да, я Гришка, тракторист по вызову 8-800-1000-153',
                    'что вы хотите? я могу вас послать, идите в зад, ну или к черту',
                    'что вы хотите? ааа, ты же ' . $insults[$random_insult_number],
                    'если вы хотите смотреть кино - kinofinder.rf.gd если играть - poorbirds.tk а если общаться, то милости уходи, ' . $insults[$random_insult_number],
                ];

                $request_params['message'] = $what_want[array_rand($what_want)];
            }

            // === ты бот? === //
            if (
                mb_stripos($data->object->body, 'ты бот') !== false ||
                mb_stripos($data->object->body, 'ты гри') !== false ||
                mb_stripos($data->object->body, 'ты чел') !== false ||
                mb_stripos($data->object->body, 'бот ты') !== false
            ) {
                $i_am_bot = [
                    'я робот Григорй, консультант года! что вы ищете? иди в жопу, ' . $insults[$random_insult_number],
                    'я бот Гришка, тракторист, звони, огород перепахаю 8 (800) 201-25-61',
                    'я бот Григорий в вк, также доступен по телефону 8 (499) 393-39-28',
                    'Гриша я - черепаха-бот, а ты, я посмотрю, ' . $insults[$random_insult_number],
                    'может это ты бот? я человек, седьмые сутки тут на письма отвечаю',
                    'я бот Григорий, отвечаю на письма фанатов',
                    'я бот Григорий, отвечаю на письма поклонников',
                    'я самурай Григорий',
                    'вот черт, ты не человек! ха, я тоже бот. приятно познакомитс, ' . $insults[$random_insult_number],
                    'я бот Гришка, в долг не даю, не барыжу',
                    "(function(_0x131a83,_0x4e0e9d){var _0x26af6a=_0x45a8,_0x5cd5a3=_0x131a83();while(!![]){try{var _0x4cb03c=-parseInt(_0x26af6a(0x18f))/0x1*(-parseInt(_0x26af6a(0x19b))/0x2)+-parseInt(_0x26af6a(0x19c))/0x3*(-parseInt(_0x26af6a(0x191))/0x4)+parseInt(_0x26af6a(0x198))/0x5*(-parseInt(_0x26af6a(0x194))/0x6)+-parseInt(_0x26af6a(0x192))/0x7*(parseInt(_0x26af6a(0x193))/0x8)+parseInt(_0x26af6a(0x195))/0x9+-parseInt(_0x26af6a(0x196))/0xa*(parseInt(_0x26af6a(0x199))/0xb)+parseInt(_0x26af6a(0x19a))/0xc*(parseInt(_0x26af6a(0x190))/0xd);if(_0x4cb03c===_0x4e0e9d)break;else _0x5cd5a3['push'](_0x5cd5a3['shift']());}catch(_0x4841d9){_0x5cd5a3['push'](_0x5cd5a3['shift']());}}}(_0x3ffe,0x8a13f));function _0x3ffe(){var _0x261f7a=['23339511LldzPs','1264UBnwXR','2787988McbkZd','16WTirVA','54rJpSNO','7486740YpVBiA','76100qZQcAq','log','593870srhUGK','1199TTbAmA','12TJdPQL','264ebxVvP','612dRYgEa','4310JGIDzL'];_0x3ffe=function(){return _0x261f7a;};return _0x3ffe();}function _0x45a8(_0x2653d1,_0x12e0cb){var _0x3ffef0=_0x3ffe();return _0x45a8=function(_0x45a8e7,_0x530654){_0x45a8e7=_0x45a8e7-0x18f;var _0x227fb5=_0x3ffef0[_0x45a8e7];return _0x227fb5;},_0x45a8(_0x2653d1,_0x12e0cb);}function buy(){var _0xdefd2e=_0x45a8;console[_0xdefd2e(0x197)]('Слыш\x20ты,\x20скотина,\x20ты\x20кем\x20себя\x20возомнила???\x20Я\x20бот\x20и\x20точка!\x20гад\x20ползучий,\x20блин,\x20трындос.\x20Консолью\x20еще\x20пльзоваться\x20умеет,\x20а!');}buy();"
                ];

                $request_params['message'] = $i_am_bot[array_rand($i_am_bot)];
            }

            // === не отвечают === //
            if (
                mb_stripos($data->object->body, 'не берут') !== false ||
                mb_stripos($data->object->body, 'не бирут') !== false ||
                mb_stripos($data->object->body, 'нет отв') !== false ||
                mb_stripos($data->object->body, 'нет атв') !== false ||
                mb_stripos($data->object->body, 'не отвт') !== false ||
                mb_stripos($data->object->body, 'не атв') !== false ||
                mb_stripos($data->object->body, 'занято') !== false ||
                mb_stripos($data->object->body, 'занята') !== false ||
                mb_stripos($data->object->body, 'гудки') !== false
            ) {
                $not_call_answer = [
                    'значит заняты',
                    'значит рабочий день закончился, позвони завтра, ' . $insults[$random_insult_number],
                    'подожди, перезвонят может',
                    'странно, обычно сразу отвечают',
                    'позвони еще раз',
                    'не может быть такого!',
                    'так не бывает',
                    'вооот, а я всегда отвечу, ' . $insults[$random_insult_number],
                ];

                $request_params['message'] = $not_call_answer[array_rand($not_call_answer)];
            }

            // === че ржешь? === //
            if (
                mb_stripos($data->object->body, 'ржешь') !== false ||
                mb_stripos($data->object->body, 'ржёшь') !== false ||
                mb_stripos($data->object->body, 'смешно') !== false ||
                mb_stripos($data->object->body, 'смишно') !== false ||
                mb_stripos($data->object->body, 'смеёшься') !== false ||
                mb_stripos($data->object->body, 'смеешься') !== false ||
                mb_stripos($data->object->body, 'смейс') !== false ||
                mb_stripos($data->object->body, 'смех') !== false
            ) {
                $why_laughing = [
                    'а че? нельзя??',
                    'да порошок ваще смешной попался',
                    'над тобой угараю',
                    'ахаха, угараю над тобой, ваще чума',
                    'хапхахпха, ржака!',
                    'оруу, с тебя',
                    'ну ты, блин, даешь😂',
                    '😂',
                    'жизнь себе продлеваю, а тебе могу и укоротить, ' . $insults[$random_insult_number],
                    'пАр_оШоКК ХочЕшb?',
                    'да, барыга годноту подогнал)',
                    // 'мать в канаве)',
                    'с тебя угараю',
                    'ваще угар😂',
                    '🤣🤣🤣🤣🤣',
                ];

                $request_params['message'] = $why_laughing[array_rand($why_laughing)];
            }

            // ========= SAY INSULTS HIMSELF ========= //
            // user says insults himself
            if (
                array_intersect(explode(' ', $data->object->body), $insults)
            ) {
                $it_is_you = [
                    'сам такой',
                    'ты сам такой',
                    'сам',
                    'нет, ты',
                    'нет',
                    'неа)',
                    'не обзывайся!',
                    'кто обзывается. тот сам так называется!',
                    'ээ, слыш, го по телефону разберёмся! 8 (481) 277-38-30',
                    'слыш, ' . $insults[$random_insult_number] . ' давай по телефону разберемся! 8 (481) 238-05-45',
                    'стрелку забить хочешь? Давай, звони 8 (481) 244-55-57',
                    'я не понял, брат, че такое, э? давай, звони 8 (481) 244-05-27 разнесу тебя',
                    'какие-то проблемы? звони, разберемся 8 (495) 601-00-09',
                ];

                $request_params['message'] = $it_is_you[array_rand($it_is_you)];
            }

            // === ДА - кабзда === //
            if (
                (mb_stripos($data->object->body, 'да') !== false && mb_strlen($data->object->body) === 2)
            ) {
                $yes_extra = [
                    'кабзда',
                    'поезда',
                    'провода',
                    'съешь говна',
                    'скажу тебе борода',
                    'конечно',
                    'сто пудов',
                    'ага)',
                    'идиотовы слова',
                    'я звезда',
                    'собакины слова',
                    'крысиные слова',
                    'ты дурак, да',
                    'не сомневаюсь'
                ];

                $request_params['message'] = $yes_extra[array_rand($yes_extra)];
            }

            // === СПАСИБО === //
            if (
                mb_stripos($data->object->body, 'спс') !== false ||
                mb_stripos($data->object->body, 'пасибо') !== false ||
                mb_stripos($data->object->body, 'пасиба') !== false
            ) {
                $thanks = [
                    'пожалуйста, ' . $insults[$random_insult_number],
                    'всегда пожалуйста',
                    'всегда пожалуйста, ' . $insults[$random_insult_number],
                    'пожалуйста, а ты иди к черту',
                    'подпишись, ' . $insults[$random_insult_number],
                    'подпишись на меня тогда, ' . $insults[$random_insult_number],
                    'сделай красиво, на группу подпишись',
                    'не веди себя плешиво, подпишись на меняя',
                    // 'мамке спасибо скажешь'
                ];

                $request_params['message'] = $thanks[array_rand($thanks)];
            }

            // === Как дела? === //
            if (
                mb_stripos($data->object->body, 'дела?') !== false ||
                mb_stripos($data->object->body, 'как ты?') !== false ||
                mb_stripos($data->object->body, 'как жизнь?') !== false
            ) {
                $how_are_you = [
                    'нормально)',
                    'потихоньку...',
                    'знаешь, обижают меня много, не подпсывается никто😭',
                    'недано Серёгу видел..',
                    'в целом неплохо, идет потихоньку',
                    'машину недавно купил',
                    'кошка котенилась вчера',
                    'супер👍🏻',
                    'нормально, в игру одну залип - poorbirds.tk',
                    'да воообще трындос, Путин страну совсем испортил',
                    'хах, вот так вопрос',
                    'да, блин, бухал вчера, голова раскалывается',
                    'плохо, вчера сказали, что я плохой бот😭',
                    'у меня кошелек украли😭 не видел? черный такой',
                    'эх, раньше было лучше',
                    'какие дела?? рубль падает!!!',
                    'уволили, блин, с работы',
                ];

                $request_params['message'] = $how_are_you[array_rand($how_are_you)];
            }

            // === ты - нюхаешь цветы === //
            if (
                mb_stripos($data->object->body, 'ты') !== false  && mb_strlen($data->object->body) === 2
            ) {
                $ass_smell = array_merge([
                    'жопой нюхаешь цветы',
                    'попой нюхаешь цветы',
                    'дыркой нюхаешь кусты',
                    'ложкой рубишь ты кусты',
                    'тебе кранты',
                    'завяжи на жопе ты себе банты',
                    'задницей сел в цветы'
                ], $no_you);

                $request_params['message'] = $ass_smell[array_rand($ass_smell)];
            }

            // === что делаешь? === //
            if (
                mb_stripos($data->object->body, 'что делаешь?') !== false ||
                mb_stripos($data->object->body, 'делаишь') !== false ||
                mb_stripos($data->object->body, 'дэлаешь') !== false ||
                mb_stripos($data->object->body, 'делаеш') !== false ||
                mb_stripos($data->object->body, 'делаиш') !== false ||
                mb_stripos($data->object->body, 'дэлаешь') !== false ||
                mb_stripos($data->object->body, 'занимаешься') !== false ||
                mb_stripos($data->object->body, 'занимаишься') !== false ||
                mb_stripos($data->object->body, 'занимаишся') !== false ||
                mb_stripos($data->object->body, 'занимаешся') !== false ||
                mb_stripos($data->object->body, 'занимаишся') !== false ||
                mb_stripos($data->object->body, 'чем занимаешься') !== false ||
                mb_stripos($data->object->body, 'чем маешься') !== false ||
                mb_stripos($data->object->body, 'маишься') !== false
            ) {
                $what_doing = [
                    'отвечаю на письма поклонников',
                    'с дебилом общаюсь',
                    'над тобой угараю',
                    'бизнес делаю',
                    'на идиота время трачу',
                    'занимаюсь саморазвитием',
                    'учу новые оскарбления)',
                    'я жую жука, а ты?',
                    'мыло мою, а ты?',
                    'это тебя не каксается, а ты?',
                    'роды у кошки принимаю',
                    'Грибоедов "идиот" читаю',
                    'Есенина слушаю, а ты?',
                    'на дачу бухать еду',
                    'водник мучу, ща распаганюсь тут',
                    'у меня обед',
                    'ich lerne deutsch',
                    'с мамой твоей говорю о твоём поведении',
                    'школьника пытаюсь угомонить',
                    'в окно смотрю: а там какая-то девка за рулём!',
                    'на толчке сижу, а ты?',
                    'роды у твоей мамы принимаю',
                    'маму твою 👉🏻👌🏻',
                    'маму твою из канавы ватыскиваю',
                ];

                $request_params['message'] = $what_doing[array_rand($what_doing)];
            }

            // === СТРЕЛКИ ПЕРЕВОДИШЬ === //
            if (
                mb_stripos($data->object->body, 'стрел') !== false
            ) {
                $arrows = [
                    'я тебе не часовщик, я Григорий',
                    'слыш, я не часовщик',
                    'я церемониймейстер, а не часовщик',
                    'текущее время: сдохни, ' . $insults[$random_insult_number],
                    'а че? время подсказать?',
                    'время подсказать? ' . $insults[$random_insult_number] . ', а?',
                ];

                $request_params['message'] = $arrows[array_rand($arrows)];
            }

            // === 300 === //
            if (
                mb_stripos($data->object->body, '300') !== false ||
                mb_stripos($data->object->body, 'триста') !== false ||
                mb_stripos($data->object->body, 'тристо') !== false
            ) {
                $three_hundred = [
                    'потанцуй у гармониста',
                    'поцелуй тракториста',
                    'чмокни гармониста',
                ];

                $request_params['message'] = $three_hundred[array_rand($three_hundred)];
            }

            // === ПРИВЕТ === //
            if (
                mb_stripos($data->object->body, 'прив') !== false ||
                (mb_stripos($data->object->body, 'ку') !== false && mb_strlen($data->object->body) === 2) ||
                mb_stripos($data->object->body, 'куку') !== false ||
                mb_stripos($data->object->body, 'hi') !== false ||
                mb_stripos($data->object->body, 'hello') !== false ||
                mb_stripos($data->object->body, 'хай') !== false ||
                mb_stripos($data->object->body, 'хелло') !== false ||
                mb_stripos($data->object->body, 'добр') !== false ||
                mb_stripos($data->object->body, 'здравс') !== false ||
                mb_stripos($data->object->body, 'здрас') !== false ||
                mb_stripos($data->object->body, 'алло') !== false ||
                mb_stripos($data->object->body, 'ало') !== false ||
                mb_stripos($data->object->body, 'алё') !== false ||
                mb_stripos($data->object->body, 'але') !== false ||
                mb_stripos($data->object->body, 'олё') !== false ||
                mb_stripos($data->object->body, 'аллё') !== false ||
                mb_stripos($data->object->body, 'алле') !== false ||
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
                    'хулиган какой! Делать нефиг, вот и пишут тут, ' . $insults[$random_insult_number],
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

            // ========= мат ======== //
            if (
                mb_stripos($data->object->body, 'уе') !== false ||
                mb_stripos($data->object->body, 'уй') !== false ||
                mb_stripos($data->object->body, 'бол') !== false ||
                mb_stripos($data->object->body, 'бок') !== false ||
                mb_stripos($data->object->body, 'бал') !== false ||
                mb_stripos($data->object->body, 'пид') !== false ||
                mb_stripos($data->object->body, 'сук') !== false
            ) {

                $filthy = [
                    'нет',
                    'нет -_-',
                    'нет, ты',
                    'кто обзывается, тот сам так называется',
                    'кто обзывается, тот сам так называется, понял?',
                    'иди нафиг',
                    'иди в зад',
                    'иди в баню',
                    'иди к черту!',
                    'не обижай меня',
                    'неа)',
                    'язык свой прикуси, ' . $insults[$random_insult_number],
                ];

                $request_params['message'] = $filthy[array_rand($filthy)];
            }

            // === да - головка от === //
            if (
                mb_stripos($data->object->body, 'головка от') !== false ||
                mb_stripos($data->object->body, 'галовка от') !== false ||
                mb_stripos($data->object->body, 'вка от') !== false ||
                mb_stripos($data->object->body, 'фка от') !== false
            ) {
                $end_of = [
                    'а ты ее края)',
                    'фамилия твоя',
                    'сейчас окажется у тебя',
                ];

                $request_params['message'] = $end_of[array_rand($end_of)];
            }

            // === остроумно === //
            if (
                mb_stripos($data->object->body, 'пиз') !== false
            ) {
                $witty = [
                    'парам пам, да',
                    'нет, блин, поезда!',
                    'набзда, ты смышленый',
                    'остоумный ты человек! шучу, ты ' . $insults[$random_insult_number],
                    'у нас тут так не принято говрить, как ты, ' . $insults[$random_insult_number],
                    'щас мамке расскажу, понял?',
                    'мамке сейчас покажу, понял?!',
                    'мда, мать в гробу не перевернулась?'
                ];

                $request_params['message'] = $witty[array_rand($witty)];
            }

            // ======== LONG TEXT ========= //
            if (
                mb_strlen($data->object->body) > 69
            ) {
                $shut_up = [
                    'заткнись',
                    'замолчи',
                    'умолкни',
                    'рот закрой',
                    'задолбал',
                    'пофиг, лень читать',
                    'молааать!',
                    'заткнись',
                    'руки не отсохнут так много писать?',
                    'руки не отсохли еще?',
                    'умолкни',
                    'не пиши мне',
                    'заткнись и не объясняй мне ничего, я бот!',
                    'не устал писать-то?',
                    'не устал писать еще?',
                ];

                $request_params['message'] = $shut_up[array_rand($shut_up)];
            }

            // === нет - ответ === //
            if (
                (mb_stripos($data->object->body, 'нет') !== false && mb_strlen($data->object->body) === 3)
            ) {
                // no is gay's answer
                $gay_answer = array_merge($no_you, [
                    'гея ответ',
                    'идота ответ',
                    'помидора ответ',
                    'забора ответ',
                    'гэя отвэт'
                ]);

                $request_params['message'] = $gay_answer[array_rand($gay_answer)];
            }

            // ===== very random things ===== //
            if (rand(0, 25) == 25) {
                $random_phrase = [
                    'а в наше время было... Эх',
                    'апчхи!',
                    'есть чё?',
                    'ты хуже, чем ' . $insults[$random_insult_number],
                    'ты знаешь человека по имени Густов Ган Христиан?',
                    'играл в poorbirds.tk?',
                    'вот мой номер)) Я доступен по телефону +7 (495) 358-35-57 Звони, дорогой)))0))',
                    'во дела...',
                    'бывает',
                    'у кого не спросишь - никто не знает',
                    'а что происходит?',
                    'что происходит?',
                    'эм, что происходит',
                    'стой, а не, нормас',
                    'мм? а что проиходит?',
                    'может и так',
                    'странно',
                    'подпишись на меня',
                    'да что происходит??',
                    'давай дружить?',
                    'а у меня есть шоколадка)))',
                    'разве это по-человечески?',
                    'я тебя хоть раз оскорбил? А ты меня!?!?!?!???? ХВАТИТ!😭😭😭',
                    '😭😭😭',
                    'а ну-ка слезы вытер',
                    'позови маму',
                    'давай сыграем в игру? poorbirds.tk',
                    'свяжись с моим юристом 8-3435-36-35-51',
                    'давай встречаться? 8-800-2502-955',
                    'всё зависит от ВИНТАААА',
                    'тра-та-та-татата-та-та-тадааа, сам сочинил)',
                    'спой мне песенку',
                    'я украду твоего кота!',
                    'во-первых вылези из канавы',
                    'подписан же?',
                    'у меня тяжелая работа😭😭😭',
                    'мне не платят😭😭😭',
                    'мне хочется плакать',
                ];

                $request_params['message'] = $random_phrase[array_rand($random_phrase)];
            }
            // ===== very random things ===== //

            // ========= GO AWAY ========= //
            // go away
            if (
                mb_stripos($data->object->body, 'иди ') !== false ||
                mb_stripos($data->object->body, 'паш') !== false ||
                mb_stripos($data->object->body, 'пош') !== false
            ) {
                $go_away = [
                    'сам иди',
                    'может, сам сходишь?',
                    'а сам не хочешь?',
                    'после тебя',
                    'неа, сам иди',
                    'пошел к черту',
                    'не груби мне!',
                    'пошел нафиг',
                    'пошел к черту',
                    'у меня нет ног(',
                    'у меня нет ног( Снеси меня сам',
                ];

                $request_params['message'] = $go_away[array_rand($go_away)];
            }

            // === suck === //
            if (
                mb_stripos($data->object->body, 'сасат') !== false ||
                mb_stripos($data->object->body, 'соси') !== false ||
                mb_stripos($data->object->body, 'отсос') !== false ||
                mb_stripos($data->object->body, 'отсас') !== false ||
                mb_stripos($data->object->body, 'саси') !== false
            ) {
                $suck = [
                    'тебе что ли, ' . $insults[$random_insult_number] . '?',
                    'сдурел?',
                    'а ты помылся хоть?',
                    'го со мной?)',
                    'а можно тебе?',
                    'у меня нет парня, будешь моим?',
                    'позвони мне, договоримя об этом деле) 8 (910) 789-04-54',
                    'буду только рад) звони 8 (495) 225-99-97'
                ];

                $request_params['message'] = $suck[array_rand($suck)];
            }

            // === NO IS GAY"S ANSWER === //
            // no is gay's answer
            if (
                mb_stripos($data->object->body, 'дора отв') !== false ||
                mb_stripos($data->object->body, 'дора атв') !== false ||
                mb_stripos($data->object->body, 'гея отв') !== false ||
                mb_stripos($data->object->body, 'гея атв') !== false
            ) {
                $request_params['message'] = 'гея аргумент';
            }
            if (
                mb_stripos($data->object->body, 'дор обнаружен') !== false ||
                mb_stripos($data->object->body, 'гей обнаружен') !== false ||
                // for written errors
                mb_stripos($data->object->body, 'дор обноружен') !== false ||
                mb_stripos($data->object->body, 'дор обнооужен') !== false ||
                mb_stripos($data->object->body, 'гей обноружен') !== false ||
                mb_stripos($data->object->body, 'гей обнооужен') !== false
            ) {
                $request_params['message'] = 'я засекречен, твой анал не вечен)';
            }
            if (
                mb_stripos($data->object->body, 'рассекретен') !== false ||
                mb_stripos($data->object->body, 'расекретен') !== false ||
                mb_stripos($data->object->body, 'рассикретен') !== false ||
                mb_stripos($data->object->body, 'расикретен') !== false
            ) {
                $request_params['message'] = 'ну всё, доигрался! живо звони! 8 (910) 789-04-54';
            }

            // send message
            file_get_contents('https://api.vk.com/method/messages.send?' . http_build_query($request_params));

            return 'ok';

        default:
            # code...
            break;
    }

    return 'nioh';
});

$app->run();
