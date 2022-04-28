<?php

class Rest
{
    private $username;
    private $password;

    protected $credentials;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->credentials = (object)(json_decode(@file_get_contents('credentials.json')) ?? [
                'idToken' => null,
                'cognitoToken' => null
            ]);
    }

    protected function authorize()
    {
        $username = $this->username;
        $password = $this->password;


        echo "first, login..." . PHP_EOL;
        $username = urlencode($username);
        $password = urlencode($password);
        $cred = $this->post(
            "https://he-accounts.force.com/SmartHome/s/sfsites/aura?r=3&other.LightningLoginCustom.login=1",
            "message=%7B%22actions%22%3A%5B%7B%22id%22%3A%2286%3Ba%22%2C%22descriptor%22%3A%22apex%3A%2F%2FLightningLoginCustomController%2FACTION%24login%22%2C%22callingDescriptor%22%3A%22markup%3A%2F%2Fc%3AloginForm%22%2C%22params%22%3A%7B%22username%22%3A%22$username%22%2C%22password%22%3A%22$password%22%2C%22startUrl%22%3A%22%2FSmartHome%2Fsetup%2Fsecur%2FRemoteAccessAuthorizationPage.apexp%3Fsource%3DCAAAAYBTRkcKMDAwMDAwMDAwMDAwMDAwAAAA7MsNUkti1fdXymR5pQ9wdj2M2b0v8zkrOuJBi_4ObXqkG2f-PSNTJbacp-PY18ITzjERFpxRCRaU0TUxAevyqtpJ4h2hP6D_sdqSG7HGQzOpPxrg0KBDTUNi2SBr7KlS9_zk1Qh21ERcEewaPRihfoNsmHr2dotQ7l0cur4KWMcwJSFnWnMTbehfNFFKF9paBF3s-jid12O5z6wD95OMzk_Qjpixqm8r60BSuBGoM08KdmkNiVgH9XKLzSd9xPr29VDBGWQFpojEwkZAjMWs6c9RA_fEs9IewQkgdFnY8TFlkT6yeQ3-hlOO8xLA3NnwwByctKziLeP934ofxXxikGsmZxt5mCnXHOw_PY6sx-2ja5xPPZdK4kmM0lOsit9IEJuk4uKCu9xz5sMmzAk1_cCMy5f3W9XnyKrKczJZdXqcCT8bqG60sYyFcJu-XgwNS9UbH967x6TNTYCv-xWzTpaJVHKMJexAxeD-7_FroIzjFNVSN1YMwp0L3EXDKEQgYM_oSbK-L1SagL3KWS3Hh4bp45ycq6ZaH4DwCXBfQOFOxJ21W-0LMCsFT7fSrkrXfocBwxdK1i8usO92iBpS1B1Erpk8LlD7F4aJZzvsRRxcYoyGbLs5BFX8o8Uk-3sDHD5z_77sSuOV0CICMfFIEtNGXtUd5PsT0G03J5iEGCRve9RlZJ5qNnjeAoL8MwmV1sEabHDN5oEzcD514y3xpuM%253D%26display%3Dtouch%22%7D%7D%5D%7D&aura.context=%7B%22mode%22%3A%22PROD%22%2C%22fwuid%22%3A%222yRFfs4WfGnFrNGn9C_dGg%22%2C%22app%22%3A%22siteforce%3AloginApp2%22%2C%22loaded%22%3A%7B%22APPLICATION%40markup%3A%2F%2Fsiteforce%3AloginApp2%22%3A%22PnuMahsrn7JWWgS2n6sUkQ%22%7D%2C%22dn%22%3A%5B%5D%2C%22globals%22%3A%7B%7D%2C%22uad%22%3Afalse%7D&aura.pageURI=%2FSmartHome%2Fs%2Flogin%2F%3Flanguage%3Den%26startURL%3D%252FSmartHome%252Fsetup%252Fsecur%252FRemoteAccessAuthorizationPage.apexp%253Fsource%253DCAAAAYBTRkcKMDAwMDAwMDAwMDAwMDAwAAAA7MsNUkti1fdXymR5pQ9wdj2M2b0v8zkrOuJBi_4ObXqkG2f-PSNTJbacp-PY18ITzjERFpxRCRaU0TUxAevyqtpJ4h2hP6D_sdqSG7HGQzOpPxrg0KBDTUNi2SBr7KlS9_zk1Qh21ERcEewaPRihfoNsmHr2dotQ7l0cur4KWMcwJSFnWnMTbehfNFFKF9paBF3s-jid12O5z6wD95OMzk_Qjpixqm8r60BSuBGoM08KdmkNiVgH9XKLzSd9xPr29VDBGWQFpojEwkZAjMWs6c9RA_fEs9IewQkgdFnY8TFlkT6yeQ3-hlOO8xLA3NnwwByctKziLeP934ofxXxikGsmZxt5mCnXHOw_PY6sx-2ja5xPPZdK4kmM0lOsit9IEJuk4uKCu9xz5sMmzAk1_cCMy5f3W9XnyKrKczJZdXqcCT8bqG60sYyFcJu-XgwNS9UbH967x6TNTYCv-xWzTpaJVHKMJexAxeD-7_FroIzjFNVSN1YMwp0L3EXDKEQgYM_oSbK-L1SagL3KWS3Hh4bp45ycq6ZaH4DwCXBfQOFOxJ21W-0LMCsFT7fSrkrXfocBwxdK1i8usO92iBpS1B1Erpk8LlD7F4aJZzvsRRxcYoyGbLs5BFX8o8Uk-3sDHD5z_77sSuOV0CICMfFIEtNGXtUd5PsT0G03J5iEGCRve9RlZJ5qNnjeAoL8MwmV1sEabHDN5oEzcD514y3xpuM%25253D%2526display%253Dtouch%26RegistrationSubChannel%3DhOn%26display%3Dtouch%26inst%3D68%26ec%3D302%26System%3DIoT_Mobile_App&aura.token=null"
        );
        $frontdoor = $this->get($cred->events[0]->attributes->values->url);
        $frontdoorUrl = substr($frontdoor, strpos($frontdoor, '<a href="') + 9);
        $frontdoorUrl = substr($frontdoorUrl, 0, strpos($frontdoorUrl, '"'));
        $this->get($frontdoorUrl);

        echo "user loggedin..." . PHP_EOL;
        $oauth2 = $this->get("https://he-accounts.force.com/SmartHome/services/oauth2/authorize?response_type=token+id_token&client_id=3MVG9QDx8IX8nP5T2Ha8ofvlmjLZl5L_gvfbT9.HJvpHGKoAS_dcMN8LYpTSYeVFCraUnV.2Ag1Ki7m4znVO6&redirect_uri=hon%3A%2F%2Fmobilesdk%2Fdetect%2Foauth%2Fdone&display=touch&scope=api%20openid%20refresh_token%20web&nonce=82e9f4d1-140e-4872-9fad-15e25fbf2b7c");
        parse_str(substr($oauth2, strpos($oauth2, '#') + 1), $params);
        $idToken = $params['id_token'];
        $cognito = $this->post(
            "https://api-iot.he.services/auth/v1/login",
            '{
              "appVersion": "1.39.2",
              "mobileId": "xxxxxxxxxxxxxxxxxx",
              "osVersion": 30,
              "os": "android",
              "deviceModel": "goldfish_x86"
            }',
            [
                'content-type: application/json',
                'id-token: ' . $idToken
            ]
        );

        $this->credentials->idToken = $idToken;
        $this->credentials->cognitoToken = $cognito->cognitoUser->Token;
        file_put_contents('credentials.json', json_encode($this->credentials));

        echo "auth set-up..." . PHP_EOL;
    }

    public function devices()
    {
        $appliance = $this->get('https://api-iot.he.services/commands/v1/appliance', [
            'cognito-token: ' . $this->credentials->cognitoToken,
            'id-token: ' . $this->credentials->idToken
        ]);

        $appliances = $appliance->payload->appliances;
    }


    public function state($macAddress): object
    {
        $response = $this->get(
            "https://api-iot.he.services/commands/v1/context?macAddress=$macAddress&applianceType=AC&category=CYCLE",
            [
                'cognito-token: ' . $this->credentials->cognitoToken,
                'id-token: ' . $this->credentials->idToken
            ]
        );
        $data = $response->payload->shadow->parameters;
        return (object)array_map(fn($val) => $val->parNewVal, (array)$data);
    }


    public function update($macAddress, $newData)
    {
        $newData = (object)$newData;
        $dt = new DateTime();
        $dt->setTimeZone(new DateTimeZone('UTC'));
        $timestamp = $dt->format('Y-m-d\TH:i:s.\0\0\0\Z');

        $state = $this->state($macAddress);

        $parameters = (array)json_decode('{
            "10degreeHeatingStatus": "0",
            "ch2oCleaningStatus": "0",
            "cleaningTimeStatus": "0",
            "echoStatus": "0",
            "electricHeatingStatus": "0",
            "energySavePeriod": "15",
            "energySavingStatus": "0",
            "filterChangeStatusCloud": "0",
            "freshAirStatus": "0",
            "halfDegreeSettingStatus": "0",
            "healthMode": "0",
            "heatAccumulationStatus": "0",
            "humanSensingStatus": "0",
            "humidificationStatus": "0",
            "humiditySel": "30",
            "intelligenceStatus": "0",
            "lightStatus": "0",
            "lockStatus": "0",
            "machMode": "4",
            "muteStatus": "0",
            "onOffStatus": "1",
            "operationName": "grSetDAC",
            "pm2p5CleaningStatus": "0",
            "pmvStatus": "0",
            "rapidMode": "0",
            "screenDisplayStatus": "1",
            "selfCleaning56Status": "0",
            "selfCleaningStatus": "0",
            "silentSleepStatus": "0",
            "specialMode": "0",
            "tempUnit": "0",
            "voiceSignStatus": "0",
            "voiceStatus": "0",
            "windDirectionHorizontal": "0",
            "windDirectionVertical": "5",
            "windSensingStatus": "0",
            "windSpeed": "5",
            "tempSel": "22"
          }');
        $values = [...(array)$state, ...(array)$newData];
        foreach ($values as $parameter => $value) {
            if (isset($parameters[$parameter]) && $parameter !== 'operationName') {
                $parameters[$parameter] = $value;
            }
        }


        $payload = [
            'macAddress' => $macAddress,
            'timestamp' => $timestamp,
            'applianceOptions' => new stdClass(),
            'applianceType' => 'AC',
            'attributes' => [
                "prStr" => $newData->machMode === "1" ? "Cool" : "Heat",
                'channel' => 'mobileApp',
                'origin' => 'standardProgram'
            ],
            'commandName' => 'startProgram',
            'device' => [
                'mobileId' => 'xxxxxxxxxxxxxxxxxxx',
                'mobileOs' => 'android',
                'osVersion' => '30',
                'appVersion' => '1.39.2',
                'deviceModel' => 'goldfish_x86'
            ],
            'transactionId' => $macAddress . '_' . $timestamp,
            'programName' => $newData->machMode === "1" ? 'PROGRAMS.AC.IOT_COOL' : 'PROGRAMS.AC.IOT_HEAT',
            'ancillaryParameters' => [
                "programFamily" => "[standard]",
                "remoteActionable" => "1",
                "remoteVisible" => "1"
            ],
            'parameters' => $parameters
        ];

        $response = $this->post(
            "https://api-iot.he.services/commands/v1/send",
            json_encode($payload),
            [
                'content-type: application/json',
                'cognito-token: ' . $this->credentials->cognitoToken,
                'id-token: ' . $this->credentials->idToken
            ]
        );
    }


    private function post($url, $data, $headers = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        $server_output = curl_exec($ch);
        curl_close($ch);
        return json_decode($server_output) ?? $server_output;
    }

    private function get($url, $headers = [])
    {
        $ch = curl_init($url);
        $headers[] = 'id-token: ' . $this->credentials->idToken;
        $headers[] = 'cognito-token: ' . $this->credentials->cognitoToken;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
        $server_output = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        curl_close($ch);

        if ($responseCode === 401) {
            $this->authorize();
            return $this->get($url, $headers);
        }
        return json_decode($server_output) ?? $server_output;
    }
}


$rest = new Rest('xxxxx@xxxxx.xx', 'xxxxxxx');
$rest->update("xx-xx-xx-xx-xx-xx", [
    'machMode' => "4", // 1=cool, 4=heat
    'onOffStatus' => "1", // Set AC Status
    'tempSel' => "21", // Set AC Target Temp,
    'windDirectionVertical' => "5", // Vertical direction of the fan,
    'windSpeed' => "5" // Fan Speed
]);

$status = $rest->state('xx-xx-xx-xx-xx-xx');

var_dump($status);

//$status->tempIndoor // Current temperature
//$status->onOffStatus // Current AC Statu
//$status->tempSel // Current Target Temperature


