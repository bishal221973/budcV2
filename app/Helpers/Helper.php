<?php

//namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

function last_check()
{

    $maintenant = \Carbon\Carbon::now(); // Utilisez le namespace complet pour éviter les conflits

    $lastCheck = \Carbon\Carbon::parse(get_option('last_check'));

    $dureeMaximale = 1; // en heures
    $dureeMaximaleToDelete = 7; // en heures

    if ($maintenant->diffInDays($lastCheck) > 1 && $maintenant->diffInDays($lastCheck) < 7) {
        return ['status' => 1, 'message' => 'Doctorino requires configuration for scheduled tasks.<br> Please set up the CronJob or add the following line to your server or contact our support: <br><br> <code>* * * * * cd ' . base_path() . ' && php artisan schedule:run >> /dev/null 2>&1</code>'];
    } elseif ($maintenant->diffInDays($lastCheck) > 7) {
        update_option('purchase_code', '');
        $cheminFichier = storage_path(base64_decode('YWN0aXZhdGVk'));
        // Vérifiez si le fichier existe avant de tenter de le supprimer
        if (File::exists($cheminFichier)) {
            File::delete($cheminFichier);
        }
        return ['status' => 2, 'message' => 'Doctorino requires configuration for scheduled tasks.<br> Please set up the CronJob or add the following line to your server or contact our support: <br><br> <code>* * * * * cd ' . base_path() . ' && php artisan schedule:run >> /dev/null 2>&1</code>'];
    } elseif ($maintenant->diffInDays($lastCheck) < 1) {



        $installedLogFile = storage_path(base64_decode('aW5zdGFsbGVk'));



        if (!file_exists($installedLogFile)) {

            $dateStamp = date('Y/m/d h:i:sa');
            file_put_contents($installedLogFile, $dateStamp);
        }

        return ['status' => 0, 'message' => base64_decode('RG9jdG9yaW5vIHJlcXVpcmVzIGNvbmZpZ3VyYXRpb24gZm9yIHNjaGVkdWxlZCB0YXNrcy48YnI+IFBsZWFzZSBzZXQgdXAgdGhlIENyb25Kb2Igb3IgYWRkIHRoZSBmb2xsb3dpbmcgbGluZSB0byB5b3VyIHNlcnZlciBvciBjb250YWN0IG91ciBzdXBwb3J0OiA8YnI+PGJyPiA8Y29kZT4qICogKiAqICogY2QgJy5iYXNlX3BhdGgoKS4nICYmIHBocCBhcnRpc2FuIHNjaGVkdWxlOnJ1biA+PiAvZGV2L251bGwgMj4mMTwvY29kZT4=')];
    } else {
        return ['status' => 0, 'message' => '']; // Votre message ici
    }
}


if (!function_exists('setEnv')) {
    function setEnv($name, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $name . '=' . env($name),
                $name . '=' . $value,
                file_get_contents($path)
            ));
        }
    }
}

if (!function_exists('activate_install_file')) {

    function activate_install_file($purchase_code)
    {

        $activatedLogFile = storage_path(base64_decode('YWN0aXZhdGVk'));

        file_put_contents($activatedLogFile, $purchase_code);


        return true;
    }
}

if (!function_exists('get_option')) {

    function get_option($option_name, $option_value = null)
    {

        $return = Setting::where('option_name', $option_name)->pluck('option_value')->first();

        if (!$return)
            return $option_value;

        return $return;
    }
}

if (!function_exists('update_option')) {

    function update_option($option_name, $option_value)
    {
        // update if already exists - create if it doesn't
        $option = Setting::firstOrCreate(['option_name' => $option_name]);
        $option->option_value = $option_value;
        $option->save();

        return $option;
    }
}

if (!function_exists('get_visitor_status')) {
    function get_visitor_status($type)
    {

        $types = ['1' => __('Sentence.Pending'), '2' => __('Sentence.Ongoing'), '3' => __('Sentence.Archived')];

        return $types[$type];
    }
}

if (!function_exists('yes_or_no')) {
    function yes_or_no($value)
    {

        $types = ['1' => __('Sentence.Yes'), '0' => __('Sentence.No')];

        return $types[$value];
    }
}



if (!function_exists('formatCurrency')) {
    function formatCurrency($amount, $currencySymbol, $position = 'left')
    {
        if ($position === 'left') {

            return "$currencySymbol$amount";
        } elseif ($position === 'left_with_space') {

            return "$currencySymbol $amount";
        } elseif ($position === 'right') {

            return "$amount$currencySymbol";
        } elseif ($position === 'right_with_space') {
            return "$amount $currencySymbol";
        } else {
            return "Invalid position parameter. Update it in Payment Settings";
        }
    }
}



if (!function_exists('flag')) {
    function flag($language)
    {

        switch ($language) {
            case 'EN':
                return 'usa.png';;
                break;

            case 'FR':
                return 'france.png';
                break;

            case 'AR':
                return 'algeria.png';
                break;

            case 'ES':
                return 'spain.png';
                break;

            case 'PT':
                return 'portugal.png';
                break;

            case 'DE':
                return 'germany.png';
                break;

            case 'RU':
                return 'russia.png';
                break;

            case 'IT':
                return 'italy.png';
                break;

            default:
                return 'usa.png';
                break;
        }
    }
}


if (!function_exists('get_currency_symbol')) {
    function get_currency_symbol()
    {

        $currencies = array(
            'United States Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'USD'
            ),
            'Euro' => array(
                'Symbol' => '€',
                'ISO' => 'EUR'
            ),
            'British Pound Sterling' => array(
                'Symbol' => '£',
                'ISO' => 'GBP'
            ),
            'Japanese Yen' => array(
                'Symbol' => '¥',
                'ISO' => 'JPY'
            ),
            'Australian Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'AUD'
            ),
            'Canadian Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'CAD'
            ),
            'Swiss Franc' => array(
                'Symbol' => 'Fr',
                'ISO' => 'CHF'
            ),
            'Chinese Yuan' => array(
                'Symbol' => '¥',
                'ISO' => 'CNY'
            ),
            'Indian Rupee' => array(
                'Symbol' => '₹',
                'ISO' => 'INR'
            ),
            'South Korean Won' => array(
                'Symbol' => '₩',
                'ISO' => 'KRW'
            ),
            'Mexican Peso' => array(
                'Symbol' => '$',
                'ISO' => 'MXN'
            ),
            'Brazilian Real' => array(
                'Symbol' => 'R$',
                'ISO' => 'BRL'
            ),
            'South African Rand' => array(
                'Symbol' => 'R',
                'ISO' => 'ZAR'
            ),
            'Russian Ruble' => array(
                'Symbol' => '₽',
                'ISO' => 'RUB'
            ),
            'Singapore Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'SGD'
            ),
            'Hong Kong Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'HKD'
            ),
            'New Zealand Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'NZD'
            ),
            'Swedish Krona' => array(
                'Symbol' => 'kr',
                'ISO' => 'SEK'
            ),
            'Norwegian Krone' => array(
                'Symbol' => 'kr',
                'ISO' => 'NOK'
            ),
            'Danish Krone' => array(
                'Symbol' => 'kr',
                'ISO' => 'DKK'
            ),
            'Afghan Afghani' => array(
                'Symbol' => '؋',
                'ISO' => 'AFN'
            ),
            'Albanian Lek' => array(
                'Symbol' => 'L',
                'ISO' => 'ALL'
            ),
            'Algerian Dinar' => array(
                'Symbol' => 'دج',
                'ISO' => 'DZD'
            ),
            'Angolan Kwanza' => array(
                'Symbol' => 'Kz',
                'ISO' => 'AOA'
            ),
            'Argentine Peso' => array(
                'Symbol' => '$',
                'ISO' => 'ARS'
            ),
            'Armenian Dram' => array(
                'Symbol' => '֏',
                'ISO' => 'AMD'
            ),
            'Azerbaijani Manat' => array(
                'Symbol' => '₼',
                'ISO' => 'AZN'
            ),
            'Bahraini Dinar' => array(
                'Symbol' => 'ب.د',
                'ISO' => 'BHD'
            ),
            'Bangladeshi Taka' => array(
                'Symbol' => '৳',
                'ISO' => 'BDT'
            ),
            'Barbadian Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'BBD'
            ),
            'Belarusian Ruble' => array(
                'Symbol' => 'Br',
                'ISO' => 'BYN'
            ),
            'Belize Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'BZD'
            ),
            'Bhutanese Ngultrum' => array(
                'Symbol' => 'Nu.',
                'ISO' => 'BTN'
            ),
            'Bolivian Boliviano' => array(
                'Symbol' => 'Bs.',
                'ISO' => 'BOB'
            ),
            'Bosnia and Herzegovina Convertible Mark' => array(
                'Symbol' => 'KM',
                'ISO' => 'BAM'
            ),
            'Botswana Pula' => array(
                'Symbol' => 'P',
                'ISO' => 'BWP'
            ),
            'Brunei Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'BND'
            ),
            'Bulgarian Lev' => array(
                'Symbol' => 'лв',
                'ISO' => 'BGN'
            ),
            'Burundian Franc' => array(
                'Symbol' => 'FBu',
                'ISO' => 'BIF'
            ),
            'Cambodian Riel' => array(
                'Symbol' => '៛',
                'ISO' => 'KHR'
            ),
            'Cape Verdean Escudo' => array(
                'Symbol' => 'CVE',
                'ISO' => 'CVE'
            ),
            'Cayman Islands Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'KYD'
            ),
            'Central African CFA Franc' => array(
                'Symbol' => 'FCFA',
                'ISO' => 'XAF'
            ),
            'Chilean Peso' => array(
                'Symbol' => '$',
                'ISO' => 'CLP'
            ),
            'Colombian Peso' => array(
                'Symbol' => '$',
                'ISO' => 'COP'
            ),
            'Comorian Franc' => array(
                'Symbol' => 'CF',
                'ISO' => 'KMF'
            ),
            'Congolese Franc' => array(
                'Symbol' => 'FC',
                'ISO' => 'CDF'
            ),
            'Costa Rican Colón' => array(
                'Symbol' => '₡',
                'ISO' => 'CRC'
            ),
            'Croatian Kuna' => array(
                'Symbol' => 'kn',
                'ISO' => 'HRK'
            ),
            'Cuban Peso' => array(
                'Symbol' => '$',
                'ISO' => 'CUP'
            ),
            'Czech Koruna' => array(
                'Symbol' => 'Kč',
                'ISO' => 'CZK'
            ),
            'Djiboutian Franc' => array(
                'Symbol' => 'Fdj',
                'ISO' => 'DJF'
            ),
            'Dominican Peso' => array(
                'Symbol' => 'RD$',
                'ISO' => 'DOP'
            ),
            'East Caribbean Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'XCD'
            ),
            'Egyptian Pound' => array(
                'Symbol' => 'E£',
                'ISO' => 'EGP'
            ),
            'Eritrean Nakfa' => array(
                'Symbol' => 'Nfk',
                'ISO' => 'ERN'
            ),
            'Estonian Euro' => array(
                'Symbol' => '€',
                'ISO' => 'EUR'
            ),
            'Ethiopian Birr' => array(
                'Symbol' => 'ብር',
                'ISO' => 'ETB'
            ),
            'Fijian Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'FJD'
            ),
            'Gambian Dalasi' => array(
                'Symbol' => 'D',
                'ISO' => 'GMD'
            ),
            'Georgian Lari' => array(
                'Symbol' => '₾',
                'ISO' => 'GEL'
            ),
            'Ghanaian Cedi' => array(
                'Symbol' => '₵',
                'ISO' => 'GHS'
            ),
            'Gibraltar Pound' => array(
                'Symbol' => '£',
                'ISO' => 'GIP'
            ),
            'Guatemalan Quetzal' => array(
                'Symbol' => 'Q',
                'ISO' => 'GTQ'
            ),
            'Guinean Franc' => array(
                'Symbol' => 'FG',
                'ISO' => 'GNF'
            ),
            'Guyanese Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'GYD'
            ),
            'Haitian Gourde' => array(
                'Symbol' => 'G',
                'ISO' => 'HTG'
            ),
            'Honduran Lempira' => array(
                'Symbol' => 'L',
                'ISO' => 'HNL'
            ),
            'Hungarian Forint' => array(
                'Symbol' => 'Ft',
                'ISO' => 'HUF'
            ),
            'Icelandic Króna' => array(
                'Symbol' => 'kr',
                'ISO' => 'ISK'
            ),
            'Indonesian Rupiah' => array(
                'Symbol' => 'Rp',
                'ISO' => 'IDR'
            ),
            'Iranian Rial' => array(
                'Symbol' => '﷼',
                'ISO' => 'IRR'
            ),
            'Iraqi Dinar' => array(
                'Symbol' => 'ع.د',
                'ISO' => 'IQD'
            ),
            'Israeli New Shekel' => array(
                'Symbol' => '₪',
                'ISO' => 'ILS'
            ),
            'Jamaican Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'JMD'
            ),
            'Jordanian Dinar' => array(
                'Symbol' => 'JD',
                'ISO' => 'JOD'
            ),
            'Kazakhstani Tenge' => array(
                'Symbol' => '₸',
                'ISO' => 'KZT'
            ),
            'Kenyan Shilling' => array(
                'Symbol' => 'KSh',
                'ISO' => 'KES'
            ),
            'Kuwaiti Dinar' => array(
                'Symbol' => 'د.ك',
                'ISO' => 'KWD'
            ),
            'Kyrgyzstani Som' => array(
                'Symbol' => 'с',
                'ISO' => 'KGS'
            ),
            'Laotian Kip' => array(
                'Symbol' => '₭',
                'ISO' => 'LAK'
            ),
            'Latvian Lats' => array(
                'Symbol' => 'Ls',
                'ISO' => 'LVL'
            ),
            'Lebanese Pound' => array(
                'Symbol' => 'ل.ل',
                'ISO' => 'LBP'
            ),
            'Lesotho Loti' => array(
                'Symbol' => 'L',
                'ISO' => 'LSL'
            ),
            'Liberian Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'LRD'
            ),
            'Libyan Dinar' => array(
                'Symbol' => 'ل.د',
                'ISO' => 'LYD'
            ),
            'Lithuanian Litas' => array(
                'Symbol' => 'Lt',
                'ISO' => 'LTL'
            ),
            'Macedonian Denar' => array(
                'Symbol' => 'ден',
                'ISO' => 'MKD'
            ),
            'Malagasy Ariary' => array(
                'Symbol' => 'Ar',
                'ISO' => 'MGA'
            ),
            'Malawian Kwacha' => array(
                'Symbol' => 'MK',
                'ISO' => 'MWK'
            ),
            'Malaysian Ringgit' => array(
                'Symbol' => 'RM',
                'ISO' => 'MYR'
            ),
            'Maldivian Rufiyaa' => array(
                'Symbol' => 'ރ.',
                'ISO' => 'MVR'
            ),
            'Mauritanian Ouguiya' => array(
                'Symbol' => 'UM',
                'ISO' => 'MRO'
            ),
            'Mauritian Rupee' => array(
                'Symbol' => '₨',
                'ISO' => 'MUR'
            ),
            'Moldovan Leu' => array(
                'Symbol' => 'L',
                'ISO' => 'MDL'
            ),
            'Mongolian Tugrik' => array(
                'Symbol' => '₮',
                'ISO' => 'MNT'
            ),
            'Moroccan Dirham' => array(
                'Symbol' => 'د.م.',
                'ISO' => 'MAD'
            ),
            'Mozambican Metical' => array(
                'Symbol' => 'MT',
                'ISO' => 'MZN'
            ),
            'Namibian Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'NAD'
            ),
            'Nepalese Rupee' => array(
                'Symbol' => 'रू',
                'ISO' => 'NPR'
            ),
            'Nicaraguan Córdoba' => array(
                'Symbol' => 'C$',
                'ISO' => 'NIO'
            ),
            'Nigerian Naira' => array(
                'Symbol' => '₦',
                'ISO' => 'NGN'
            ),
            'North Korean Won' => array(
                'Symbol' => '₩',
                'ISO' => 'KPW'
            ),
            'Omani Rial' => array(
                'Symbol' => 'ر.ع.',
                'ISO' => 'OMR'
            ),
            'Pakistani Rupee' => array(
                'Symbol' => '₨',
                'ISO' => 'PKR'
            ),
            'Panamanian Balboa' => array(
                'Symbol' => 'B/.',
                'ISO' => 'PAB'
            ),
            'Papua New Guinean Kina' => array(
                'Symbol' => 'K',
                'ISO' => 'PGK'
            ),
            'Paraguayan Guarani' => array(
                'Symbol' => '₲',
                'ISO' => 'PYG'
            ),
            'Peruvian Nuevo Sol' => array(
                'Symbol' => 'S/.',
                'ISO' => 'PEN'
            ),
            'Philippine Peso' => array(
                'Symbol' => '₱',
                'ISO' => 'PHP'
            ),
            'Polish Zloty' => array(
                'Symbol' => 'zł',
                'ISO' => 'PLN'
            ),
            'Qatari Rial' => array(
                'Symbol' => 'ر.ق',
                'ISO' => 'QAR'
            ),
            'Romanian Leu' => array(
                'Symbol' => 'lei',
                'ISO' => 'RON'
            ),
            'Rwandan Franc' => array(
                'Symbol' => 'FRw',
                'ISO' => 'RWF'
            ),
            'Saint Helena Pound' => array(
                'Symbol' => '£',
                'ISO' => 'SHP'
            ),
            'Samoan Tala' => array(
                'Symbol' => 'T',
                'ISO' => 'WST'
            ),
            'São Tomé and Príncipe Dobra' => array(
                'Symbol' => 'Db',
                'ISO' => 'STN'
            ),
            'Saudi Riyal' => array(
                'Symbol' => 'ر.س',
                'ISO' => 'SAR'
            ),
            'Serbian Dinar' => array(
                'Symbol' => 'дин.',
                'ISO' => 'RSD'
            ),
            'Seychellois Rupee' => array(
                'Symbol' => '₨',
                'ISO' => 'SCR'
            ),
            'Sierra Leonean Leone' => array(
                'Symbol' => 'Le',
                'ISO' => 'SLL'
            ),
            'Solomon Islands Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'SBD'
            ),
            'Somali Shilling' => array(
                'Symbol' => 'Sh',
                'ISO' => 'SOS'
            ),
            'South Sudanese Pound' => array(
                'Symbol' => '£',
                'ISO' => 'SSP'
            ),
            'Sri Lankan Rupee' => array(
                'Symbol' => '₨',
                'ISO' => 'LKR'
            ),
            'Sudanese Pound' => array(
                'Symbol' => '£',
                'ISO' => 'SDG'
            ),
            'Surinamese Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'SRD'
            ),
            'Swazi Lilangeni' => array(
                'Symbol' => 'L',
                'ISO' => 'SZL'
            ),
            'Syrian Pound' => array(
                'Symbol' => 'ل.س',
                'ISO' => 'SYP'
            ),
            'Tajikistani Somoni' => array(
                'Symbol' => 'ЅМ',
                'ISO' => 'TJS'
            ),
            'Tanzanian Shilling' => array(
                'Symbol' => 'TSh',
                'ISO' => 'TZS'
            ),
            'Thai Baht' => array(
                'Symbol' => '฿',
                'ISO' => 'THB'
            ),
            'Tongan Paʻanga' => array(
                'Symbol' => 'T$',
                'ISO' => 'TOP'
            ),
            'Trinidad and Tobago Dollar' => array(
                'Symbol' => '$',
                'ISO' => 'TTD'
            ),
            'Tunisian Dinar' => array(
                'Symbol' => 'د.ت',
                'ISO' => 'TND'
            ),
            'Turkish Lira' => array(
                'Symbol' => '₺',
                'ISO' => 'TRY'
            ),
            'Turkmenistani Manat' => array(
                'Symbol' => 'm',
                'ISO' => 'TMT'
            ),
            'Ugandan Shilling' => array(
                'Symbol' => 'USh',
                'ISO' => 'UGX'
            ),
            'Ukrainian Hryvnia' => array(
                'Symbol' => '₴',
                'ISO' => 'UAH'
            ),
            'United Arab Emirates Dirham' => array(
                'Symbol' => 'د.إ',
                'ISO' => 'AED'
            ),
            'Uruguayan Peso' => array(
                'Symbol' => '$',
                'ISO' => 'UYU'
            ),
            'Uzbekistani Som' => array(
                'Symbol' => 'soʻm',
                'ISO' => 'UZS'
            ),
            'Vanuatu Vatu' => array(
                'Symbol' => 'VT',
                'ISO' => 'VUV'
            ),
            'Venezuelan Bolívar' => array(
                'Symbol' => 'Bs.',
                'ISO' => 'VES'
            ),
            'Vietnamese Dong' => array(
                'Symbol' => '₫',
                'ISO' => 'VND'
            ),
            'Yemeni Rial' => array(
                'Symbol' => '﷼',
                'ISO' => 'YER'
            ),
            'Zambian Kwacha' => array(
                'Symbol' => 'K',
                'ISO' => 'ZMW'
            ),
            'Zimbabwean Dollar' => array(
                'Symbol' => 'Z$',
                'ISO' => 'ZWL'
            ),
            // Ajoutez d'autres monnaies ici...
        );

        return $currencies;
    }
}

function bs_to_ad($npDate)
{
    return \App\Helpers\BSDateHelper::BsToAd('-', $npDate);
}
function ad_to_bs($enDate)
{
    return \App\Helpers\BSDateHelper::AdToBsEn('-', $enDate);
}
function truncateWithEllipsis($string, $length)
{
    // Check if the string length exceeds the specified length
    if (strlen($string) > $length) {
        // Truncate and append "..."
        return substr($string, 0, $length) . '...';
    }
    return $string;
}

function setActive($path, $active = 'bg-info text-white')
{
    return Request::routeIs($path) ? $active : '';
}

function computeAmount($discount, $discountType, $total)
{
    if ($discountType == 'Amount') {
        return $total - $discount;
    }

    $discountAmt = $total * $discount / 100;

    return $total - $discountAmt;
}
