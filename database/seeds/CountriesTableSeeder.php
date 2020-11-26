<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('countries')->delete();

        \DB::table('countries')->insert(array (
            0 =>
            array (
                'id' => 1,
                'long_name' => 'Afghanistan',
                'short_name' => 'AF',
                'currency_id' => 11,
            ),
            1 =>
            array (
                'id' => 2,
                'long_name' => 'Albania',
                'short_name' => 'AL',
            'currency_id' => 11,
),
            2 =>
            array (
                'id' => 3,
                'long_name' => 'Algeria',
                'short_name' => 'DZ',
                'currency_id' => 10,
            ),
            3 =>
            array (
                'id' => 4,
                'long_name' => 'American Samoa',
                'short_name' => 'DS',
            'currency_id' => 11,
),
            4 =>
            array (
                'id' => 5,
                'long_name' => 'Andorra',
                'short_name' => 'AD',
            'currency_id' => 11,
),
            5 =>
            array (
                'id' => 6,
                'long_name' => 'Angola',
                'short_name' => 'AO',
            'currency_id' => 11,
),
            6 =>
            array (
                'id' => 7,
                'long_name' => 'Anguilla',
                'short_name' => 'AI',
            'currency_id' => 11,
),
            7 =>
            array (
                'id' => 8,
                'long_name' => 'Antarctica',
                'short_name' => 'AQ',
            'currency_id' => 11,
),
            8 =>
            array (
                'id' => 9,
                'long_name' => 'Antigua and/or Barbuda',
                'short_name' => 'AG',
            'currency_id' => 11,
),
            9 =>
            array (
                'id' => 10,
                'long_name' => 'Argentina',
                'short_name' => 'AR',
            'currency_id' => 11,
),
            10 =>
            array (
                'id' => 11,
                'long_name' => 'Armenia',
                'short_name' => 'AM',
            'currency_id' => 11,
),
            11 =>
            array (
                'id' => 12,
                'long_name' => 'Aruba',
                'short_name' => 'AW',
            'currency_id' => 11,
),
            12 =>
            array (
                'id' => 13,
                'long_name' => 'Australia',
                'short_name' => 'AU',
            'currency_id' => 11,
),
            13 =>
            array (
                'id' => 14,
                'long_name' => 'Austria',
                'short_name' => 'AT',
            'currency_id' => 11,
),
            14 =>
            array (
                'id' => 15,
                'long_name' => 'Azerbaijan',
                'short_name' => 'AZ',
            'currency_id' => 11,
),
            15 =>
            array (
                'id' => 16,
                'long_name' => 'Bahamas',
                'short_name' => 'BS',
            'currency_id' => 11,
),
            16 =>
            array (
                'id' => 17,
                'long_name' => 'Bahrain',
                'short_name' => 'BH',
                'currency_id' => 2,
            ),
            17 =>
            array (
                'id' => 18,
                'long_name' => 'Bangladesh',
                'short_name' => 'BD',
            'currency_id' => 11,
),
            18 =>
            array (
                'id' => 19,
                'long_name' => 'Barbados',
                'short_name' => 'BB',
            'currency_id' => 11,
),
            19 =>
            array (
                'id' => 20,
                'long_name' => 'Belarus',
                'short_name' => 'BY',
            'currency_id' => 11,
),
            20 =>
            array (
                'id' => 21,
                'long_name' => 'Belgium',
                'short_name' => 'BE',
            'currency_id' => 11,
),
            21 =>
            array (
                'id' => 22,
                'long_name' => 'Belize',
                'short_name' => 'BZ',
            'currency_id' => 11,
),
            22 =>
            array (
                'id' => 23,
                'long_name' => 'Benin',
                'short_name' => 'BJ',
            'currency_id' => 11,
),
            23 =>
            array (
                'id' => 24,
                'long_name' => 'Bermuda',
                'short_name' => 'BM',
            'currency_id' => 11,
),
            24 =>
            array (
                'id' => 25,
                'long_name' => 'Bhutan',
                'short_name' => 'BT',
            'currency_id' => 11,
),
            25 =>
            array (
                'id' => 26,
                'long_name' => 'Bolivia',
                'short_name' => 'BO',
            'currency_id' => 11,
),
            26 =>
            array (
                'id' => 27,
                'long_name' => 'Bosnia and Herzegovina',
                'short_name' => 'BA',
            'currency_id' => 11,
),
            27 =>
            array (
                'id' => 28,
                'long_name' => 'Botswana',
                'short_name' => 'BW',
            'currency_id' => 11,
),
            28 =>
            array (
                'id' => 29,
                'long_name' => 'Bouvet Island',
                'short_name' => 'BV',
            'currency_id' => 11,
),
            29 =>
            array (
                'id' => 30,
                'long_name' => 'Brazil',
                'short_name' => 'BR',
            'currency_id' => 11,
),
            30 =>
            array (
                'id' => 31,
                'long_name' => 'British lndian Ocean Territory',
                'short_name' => 'IO',
            'currency_id' => 11,
),
            31 =>
            array (
                'id' => 32,
                'long_name' => 'Brunei Darussalam',
                'short_name' => 'BN',
            'currency_id' => 11,
),
            32 =>
            array (
                'id' => 33,
                'long_name' => 'Bulgaria',
                'short_name' => 'BG',
            'currency_id' => 11,
),
            33 =>
            array (
                'id' => 34,
                'long_name' => 'Burkina Faso',
                'short_name' => 'BF',
            'currency_id' => 11,
),
            34 =>
            array (
                'id' => 35,
                'long_name' => 'Burundi',
                'short_name' => 'BI',
            'currency_id' => 11,
),
            35 =>
            array (
                'id' => 36,
                'long_name' => 'Cambodia',
                'short_name' => 'KH',
            'currency_id' => 11,
),
            36 =>
            array (
                'id' => 37,
                'long_name' => 'Cameroon',
                'short_name' => 'CM',
            'currency_id' => 11,
),
            37 =>
            array (
                'id' => 38,
                'long_name' => 'Canada',
                'short_name' => 'CA',
            'currency_id' => 11,
),
            38 =>
            array (
                'id' => 39,
                'long_name' => 'Cape Verde',
                'short_name' => 'CV',
            'currency_id' => 11,
),
            39 =>
            array (
                'id' => 40,
                'long_name' => 'Cayman Islands',
                'short_name' => 'KY',
            'currency_id' => 11,
),
            40 =>
            array (
                'id' => 41,
                'long_name' => 'Central African Republic',
                'short_name' => 'CF',
            'currency_id' => 11,
),
            41 =>
            array (
                'id' => 42,
                'long_name' => 'Chad',
                'short_name' => 'TD',
            'currency_id' => 11,
),
            42 =>
            array (
                'id' => 43,
                'long_name' => 'Chile',
                'short_name' => 'CL',
            'currency_id' => 11,
),
            43 =>
            array (
                'id' => 44,
                'long_name' => 'China',
                'short_name' => 'CN',
            'currency_id' => 11,
),
            44 =>
            array (
                'id' => 45,
                'long_name' => 'Christmas Island',
                'short_name' => 'CX',
            'currency_id' => 11,
),
            45 =>
            array (
                'id' => 46,
            'long_name' => 'Cocos (Keeling) Islands',
                'short_name' => 'CC',
            'currency_id' => 11,
),
            46 =>
            array (
                'id' => 47,
                'long_name' => 'Colombia',
                'short_name' => 'CO',
            'currency_id' => 11,
),
            47 =>
            array (
                'id' => 48,
                'long_name' => 'Comoros',
                'short_name' => 'KM',
            'currency_id' => 11,
),
            48 =>
            array (
                'id' => 49,
                'long_name' => 'Congo',
                'short_name' => 'CG',
            'currency_id' => 11,
),
            49 =>
            array (
                'id' => 50,
                'long_name' => 'Cook Islands',
                'short_name' => 'CK',
            'currency_id' => 11,
),
            50 =>
            array (
                'id' => 51,
                'long_name' => 'Costa Rica',
                'short_name' => 'CR',
            'currency_id' => 11,
),
            51 =>
            array (
                'id' => 52,
            'long_name' => 'Croatia (Hrvatska)',
                'short_name' => 'HR',
            'currency_id' => 11,
),
            52 =>
            array (
                'id' => 53,
                'long_name' => 'Cuba',
                'short_name' => 'CU',
            'currency_id' => 11,
),
            53 =>
            array (
                'id' => 54,
                'long_name' => 'Cyprus',
                'short_name' => 'CY',
            'currency_id' => 11,
),
            54 =>
            array (
                'id' => 55,
                'long_name' => 'Czech Republic',
                'short_name' => 'CZ',
            'currency_id' => 11,
),
            55 =>
            array (
                'id' => 56,
                'long_name' => 'Denmark',
                'short_name' => 'DK',
            'currency_id' => 11,
),
            56 =>
            array (
                'id' => 57,
                'long_name' => 'Djibouti',
                'short_name' => 'DJ',
            'currency_id' => 11,
),
            57 =>
            array (
                'id' => 58,
                'long_name' => 'Dominica',
                'short_name' => 'DM',
            'currency_id' => 11,
),
            58 =>
            array (
                'id' => 59,
                'long_name' => 'Dominican Republic',
                'short_name' => 'DO',
            'currency_id' => 11,
),
            59 =>
            array (
                'id' => 60,
                'long_name' => 'East Timor',
                'short_name' => 'TP',
            'currency_id' => 11,
),
            60 =>
            array (
                'id' => 61,
                'long_name' => 'Ecuador',
                'short_name' => 'EC',
            'currency_id' => 11,
),
            61 =>
            array (
                'id' => 62,
                'long_name' => 'Egypt',
                'short_name' => 'EG',
                'currency_id' => 4,
            ),
            62 =>
            array (
                'id' => 63,
                'long_name' => 'El Salvador',
                'short_name' => 'SV',
            'currency_id' => 11,
),
            63 =>
            array (
                'id' => 64,
                'long_name' => 'Equatorial Guinea',
                'short_name' => 'GQ',
            'currency_id' => 11,
),
            64 =>
            array (
                'id' => 65,
                'long_name' => 'Eritrea',
                'short_name' => 'ER',
            'currency_id' => 11,
),
            65 =>
            array (
                'id' => 66,
                'long_name' => 'Estonia',
                'short_name' => 'EE',
            'currency_id' => 11,
),
            66 =>
            array (
                'id' => 67,
                'long_name' => 'Ethiopia',
                'short_name' => 'ET',
            'currency_id' => 11,
),
            67 =>
            array (
                'id' => 68,
            'long_name' => 'Falkland Islands (Malvinas)',
                'short_name' => 'FK',
            'currency_id' => 11,
),
            68 =>
            array (
                'id' => 69,
                'long_name' => 'Faroe Islands',
                'short_name' => 'FO',
            'currency_id' => 11,
),
            69 =>
            array (
                'id' => 70,
                'long_name' => 'Fiji',
                'short_name' => 'FJ',
            'currency_id' => 11,
),
            70 =>
            array (
                'id' => 71,
                'long_name' => 'Finland',
                'short_name' => 'FI',
            'currency_id' => 11,
),
            71 =>
            array (
                'id' => 72,
                'long_name' => 'France',
                'short_name' => 'FR',
            'currency_id' => 11,
),
            72 =>
            array (
                'id' => 73,
                'long_name' => 'France, Metropolitan',
                'short_name' => 'FX',
            'currency_id' => 11,
),
            73 =>
            array (
                'id' => 74,
                'long_name' => 'French Guiana',
                'short_name' => 'GF',
            'currency_id' => 11,
),
            74 =>
            array (
                'id' => 75,
                'long_name' => 'French Polynesia',
                'short_name' => 'PF',
            'currency_id' => 11,
),
            75 =>
            array (
                'id' => 76,
                'long_name' => 'French Southern Territories',
                'short_name' => 'TF',
            'currency_id' => 11,
),
            76 =>
            array (
                'id' => 77,
                'long_name' => 'Gabon',
                'short_name' => 'GA',
            'currency_id' => 11,
),
            77 =>
            array (
                'id' => 78,
                'long_name' => 'Gambia',
                'short_name' => 'GM',
            'currency_id' => 11,
),
            78 =>
            array (
                'id' => 79,
                'long_name' => 'Georgia',
                'short_name' => 'GE',
            'currency_id' => 11,
),
            79 =>
            array (
                'id' => 80,
                'long_name' => 'Germany',
                'short_name' => 'DE',
            'currency_id' => 11,
),
            80 =>
            array (
                'id' => 81,
                'long_name' => 'Ghana',
                'short_name' => 'GH',
            'currency_id' => 11,
),
            81 =>
            array (
                'id' => 82,
                'long_name' => 'Gibraltar',
                'short_name' => 'GI',
            'currency_id' => 11,
),
            82 =>
            array (
                'id' => 83,
                'long_name' => 'Greece',
                'short_name' => 'GR',
            'currency_id' => 11,
),
            83 =>
            array (
                'id' => 84,
                'long_name' => 'Greenland',
                'short_name' => 'GL',
            'currency_id' => 11,
),
            84 =>
            array (
                'id' => 85,
                'long_name' => 'Grenada',
                'short_name' => 'GD',
            'currency_id' => 11,
),
            85 =>
            array (
                'id' => 86,
                'long_name' => 'Guadeloupe',
                'short_name' => 'GP',
            'currency_id' => 11,
),
            86 =>
            array (
                'id' => 87,
                'long_name' => 'Guam',
                'short_name' => 'GU',
            'currency_id' => 11,
),
            87 =>
            array (
                'id' => 88,
                'long_name' => 'Guatemala',
                'short_name' => 'GT',
            'currency_id' => 11,
),
            88 =>
            array (
                'id' => 89,
                'long_name' => 'Guinea',
                'short_name' => 'GN',
            'currency_id' => 11,
),
            89 =>
            array (
                'id' => 90,
                'long_name' => 'Guinea-Bissau',
                'short_name' => 'GW',
            'currency_id' => 11,
),
            90 =>
            array (
                'id' => 91,
                'long_name' => 'Guyana',
                'short_name' => 'GY',
            'currency_id' => 11,
),
            91 =>
            array (
                'id' => 92,
                'long_name' => 'Haiti',
                'short_name' => 'HT',
            'currency_id' => 11,
),
            92 =>
            array (
                'id' => 93,
                'long_name' => 'Heard and Mc Donald Islands',
                'short_name' => 'HM',
            'currency_id' => 11,
),
            93 =>
            array (
                'id' => 94,
                'long_name' => 'Honduras',
                'short_name' => 'HN',
            'currency_id' => 11,
),
            94 =>
            array (
                'id' => 95,
                'long_name' => 'Hong Kong',
                'short_name' => 'HK',
            'currency_id' => 11,
),
            95 =>
            array (
                'id' => 96,
                'long_name' => 'Hungary',
                'short_name' => 'HU',
            'currency_id' => 11,
),
            96 =>
            array (
                'id' => 97,
                'long_name' => 'Iceland',
                'short_name' => 'IS',
            'currency_id' => 11,
),
            97 =>
            array (
                'id' => 98,
                'long_name' => 'India',
                'short_name' => 'IN',
            'currency_id' => 11,
),
            98 =>
            array (
                'id' => 99,
                'long_name' => 'Indonesia',
                'short_name' => 'ID',
            'currency_id' => 11,
),
            99 =>
            array (
                'id' => 100,
            'long_name' => 'Iran (Islamic Republic of)',
                'short_name' => 'IR',
            'currency_id' => 11,
),
            100 =>
            array (
                'id' => 101,
                'long_name' => 'Iraq',
                'short_name' => 'IQ',
            'currency_id' => 11,
),
            101 =>
            array (
                'id' => 102,
                'long_name' => 'Ireland',
                'short_name' => 'IE',
            'currency_id' => 11,
),
            102 =>
            array (
                'id' => 103,
                'long_name' => 'Israel',
                'short_name' => 'IL',
            'currency_id' => 11,
),
            103 =>
            array (
                'id' => 104,
                'long_name' => 'Italy',
                'short_name' => 'IT',
            'currency_id' => 11,
),
            104 =>
            array (
                'id' => 105,
                'long_name' => 'Ivory Coast',
                'short_name' => 'CI',
            'currency_id' => 11,
),
            105 =>
            array (
                'id' => 106,
                'long_name' => 'Jamaica',
                'short_name' => 'JM',
            'currency_id' => 11,
),
            106 =>
            array (
                'id' => 107,
                'long_name' => 'Japan',
                'short_name' => 'JP',
            'currency_id' => 11,
),
            107 =>
            array (
                'id' => 108,
                'long_name' => 'Jordan',
                'short_name' => 'JO',
            'currency_id' => 11,
),
            108 =>
            array (
                'id' => 109,
                'long_name' => 'Kazakhstan',
                'short_name' => 'KZ',
            'currency_id' => 11,
),
            109 =>
            array (
                'id' => 110,
                'long_name' => 'Kenya',
                'short_name' => 'KE',
            'currency_id' => 11,
),
            110 =>
            array (
                'id' => 111,
                'long_name' => 'Kiribati',
                'short_name' => 'KI',
            'currency_id' => 11,
),
            111 =>
            array (
                'id' => 112,
                'long_name' => 'Korea, Democratic People\'s Republic of',
                'short_name' => 'KP',
            'currency_id' => 11,
),
            112 =>
            array (
                'id' => 113,
                'long_name' => 'Korea, Republic of',
                'short_name' => 'KR',
            'currency_id' => 11,
),
            113 =>
            array (
                'id' => 114,
                'long_name' => 'Kosovo',
                'short_name' => 'XK',
            'currency_id' => 11,
),
            114 =>
            array (
                'id' => 115,
                'long_name' => 'Kuwait',
                'short_name' => 'KW',
                'currency_id' => 3,
            ),
            115 =>
            array (
                'id' => 116,
                'long_name' => 'Kyrgyzstan',
                'short_name' => 'KG',
            'currency_id' => 11,
),
            116 =>
            array (
                'id' => 117,
                'long_name' => 'Lao People\'s Democratic Republic',
                'short_name' => 'LA',
            'currency_id' => 11,
),
            117 =>
            array (
                'id' => 118,
                'long_name' => 'Latvia',
                'short_name' => 'LV',
            'currency_id' => 11,
),
            118 =>
            array (
                'id' => 119,
                'long_name' => 'Lebanon',
                'short_name' => 'LB',
            'currency_id' => 11,
),
            119 =>
            array (
                'id' => 120,
                'long_name' => 'Lesotho',
                'short_name' => 'LS',
            'currency_id' => 11,
),
            120 =>
            array (
                'id' => 121,
                'long_name' => 'Liberia',
                'short_name' => 'LR',
            'currency_id' => 11,
),
            121 =>
            array (
                'id' => 122,
                'long_name' => 'Libyan Arab Jamahiriya',
                'short_name' => 'LY',
            'currency_id' => 11,
),
            122 =>
            array (
                'id' => 123,
                'long_name' => 'Liechtenstein',
                'short_name' => 'LI',
            'currency_id' => 11,
),
            123 =>
            array (
                'id' => 124,
                'long_name' => 'Lithuania',
                'short_name' => 'LT',
            'currency_id' => 11,
),
            124 =>
            array (
                'id' => 125,
                'long_name' => 'Luxembourg',
                'short_name' => 'LU',
            'currency_id' => 11,
),
            125 =>
            array (
                'id' => 126,
                'long_name' => 'Macau',
                'short_name' => 'MO',
            'currency_id' => 11,
),
            126 =>
            array (
                'id' => 127,
                'long_name' => 'Macedonia',
                'short_name' => 'MK',
            'currency_id' => 11,
),
            127 =>
            array (
                'id' => 128,
                'long_name' => 'Madagascar',
                'short_name' => 'MG',
            'currency_id' => 11,
),
            128 =>
            array (
                'id' => 129,
                'long_name' => 'Malawi',
                'short_name' => 'MW',
            'currency_id' => 11,
),
            129 =>
            array (
                'id' => 130,
                'long_name' => 'Malaysia',
                'short_name' => 'MY',
            'currency_id' => 11,
),
            130 =>
            array (
                'id' => 131,
                'long_name' => 'Maldives',
                'short_name' => 'MV',
            'currency_id' => 11,
),
            131 =>
            array (
                'id' => 132,
                'long_name' => 'Mali',
                'short_name' => 'ML',
            'currency_id' => 11,
),
            132 =>
            array (
                'id' => 133,
                'long_name' => 'Malta',
                'short_name' => 'MT',
            'currency_id' => 11,
),
            133 =>
            array (
                'id' => 134,
                'long_name' => 'Marshall Islands',
                'short_name' => 'MH',
            'currency_id' => 11,
),
            134 =>
            array (
                'id' => 135,
                'long_name' => 'Martinique',
                'short_name' => 'MQ',
            'currency_id' => 11,
),
            135 =>
            array (
                'id' => 136,
                'long_name' => 'Mauritania',
                'short_name' => 'MR',
            'currency_id' => 11,
),
            136 =>
            array (
                'id' => 137,
                'long_name' => 'Mauritius',
                'short_name' => 'MU',
            'currency_id' => 11,
),
            137 =>
            array (
                'id' => 138,
                'long_name' => 'Mayotte',
                'short_name' => 'TY',
            'currency_id' => 11,
),
            138 =>
            array (
                'id' => 139,
                'long_name' => 'Mexico',
                'short_name' => 'MX',
            'currency_id' => 11,
),
            139 =>
            array (
                'id' => 140,
                'long_name' => 'Micronesia, Federated States of',
                'short_name' => 'FM',
            'currency_id' => 11,
),
            140 =>
            array (
                'id' => 141,
                'long_name' => 'Moldova, Republic of',
                'short_name' => 'MD',
            'currency_id' => 11,
),
            141 =>
            array (
                'id' => 142,
                'long_name' => 'Monaco',
                'short_name' => 'MC',
            'currency_id' => 11,
),
            142 =>
            array (
                'id' => 143,
                'long_name' => 'Mongolia',
                'short_name' => 'MN',
            'currency_id' => 11,
),
            143 =>
            array (
                'id' => 144,
                'long_name' => 'Montenegro',
                'short_name' => 'ME',
            'currency_id' => 11,
),
            144 =>
            array (
                'id' => 145,
                'long_name' => 'Montserrat',
                'short_name' => 'MS',
            'currency_id' => 11,
),
            145 =>
            array (
                'id' => 146,
                'long_name' => 'Morocco',
                'short_name' => 'MA',
            'currency_id' => 11,
),
            146 =>
            array (
                'id' => 147,
                'long_name' => 'Mozambique',
                'short_name' => 'MZ',
            'currency_id' => 11,
),
            147 =>
            array (
                'id' => 148,
                'long_name' => 'Myanmar',
                'short_name' => 'MM',
            'currency_id' => 11,
),
            148 =>
            array (
                'id' => 149,
                'long_name' => 'Namibia',
                'short_name' => 'NA',
            'currency_id' => 11,
),
            149 =>
            array (
                'id' => 150,
                'long_name' => 'Nauru',
                'short_name' => 'NR',
            'currency_id' => 11,
),
            150 =>
            array (
                'id' => 151,
                'long_name' => 'Nepal',
                'short_name' => 'NP',
            'currency_id' => 11,
),
            151 =>
            array (
                'id' => 152,
                'long_name' => 'Netherlands',
                'short_name' => 'NL',
            'currency_id' => 11,
),
            152 =>
            array (
                'id' => 153,
                'long_name' => 'Netherlands Antilles',
                'short_name' => 'AN',
            'currency_id' => 11,
),
            153 =>
            array (
                'id' => 154,
                'long_name' => 'New Caledonia',
                'short_name' => 'NC',
            'currency_id' => 11,
),
            154 =>
            array (
                'id' => 155,
                'long_name' => 'New Zealand',
                'short_name' => 'NZ',
            'currency_id' => 11,
),
            155 =>
            array (
                'id' => 156,
                'long_name' => 'Nicaragua',
                'short_name' => 'NI',
            'currency_id' => 11,
),
            156 =>
            array (
                'id' => 157,
                'long_name' => 'Niger',
                'short_name' => 'NE',
            'currency_id' => 11,
),
            157 =>
            array (
                'id' => 158,
                'long_name' => 'Nigeria',
                'short_name' => 'NG',
            'currency_id' => 11,
),
            158 =>
            array (
                'id' => 159,
                'long_name' => 'Niue',
                'short_name' => 'NU',
            'currency_id' => 11,
),
            159 =>
            array (
                'id' => 160,
                'long_name' => 'Norfork Island',
                'short_name' => 'NF',
            'currency_id' => 11,
),
            160 =>
            array (
                'id' => 161,
                'long_name' => 'Northern Mariana Islands',
                'short_name' => 'MP',
            'currency_id' => 11,
),
            161 =>
            array (
                'id' => 162,
                'long_name' => 'Norway',
                'short_name' => 'NO',
            'currency_id' => 11,
),
            162 =>
            array (
                'id' => 163,
                'long_name' => 'Oman',
                'short_name' => 'OM',
            'currency_id' => 11,
),
            163 =>
            array (
                'id' => 164,
                'long_name' => 'Pakistan',
                'short_name' => 'PK',
            'currency_id' => 11,
),
            164 =>
            array (
                'id' => 165,
                'long_name' => 'Palau',
                'short_name' => 'PW',
            'currency_id' => 11,
),
            165 =>
            array (
                'id' => 166,
                'long_name' => 'Panama',
                'short_name' => 'PA',
            'currency_id' => 11,
),
            166 =>
            array (
                'id' => 167,
                'long_name' => 'Papua New Guinea',
                'short_name' => 'PG',
            'currency_id' => 11,
),
            167 =>
            array (
                'id' => 168,
                'long_name' => 'Paraguay',
                'short_name' => 'PY',
            'currency_id' => 11,
),
            168 =>
            array (
                'id' => 169,
                'long_name' => 'Peru',
                'short_name' => 'PE',
            'currency_id' => 11,
),
            169 =>
            array (
                'id' => 170,
                'long_name' => 'Philippines',
                'short_name' => 'PH',
            'currency_id' => 11,
),
            170 =>
            array (
                'id' => 171,
                'long_name' => 'Pitcairn',
                'short_name' => 'PN',
            'currency_id' => 11,
),
            171 =>
            array (
                'id' => 172,
                'long_name' => 'Poland',
                'short_name' => 'PL',
            'currency_id' => 11,
),
            172 =>
            array (
                'id' => 173,
                'long_name' => 'Portugal',
                'short_name' => 'PT',
            'currency_id' => 11,
),
            173 =>
            array (
                'id' => 174,
                'long_name' => 'Puerto Rico',
                'short_name' => 'PR',
            'currency_id' => 11,
),
            174 =>
            array (
                'id' => 175,
                'long_name' => 'Qatar',
                'short_name' => 'QR',
                'currency_id' => 7,
            ),
            175 =>
            array (
                'id' => 176,
                'long_name' => 'Reunion',
                'short_name' => 'RE',
            'currency_id' => 11,
),
            176 =>
            array (
                'id' => 177,
                'long_name' => 'Romania',
                'short_name' => 'RO',
            'currency_id' => 11,
),
            177 =>
            array (
                'id' => 178,
                'long_name' => 'Russian Federation',
                'short_name' => 'RU',
            'currency_id' => 11,
),
            178 =>
            array (
                'id' => 179,
                'long_name' => 'Rwanda',
                'short_name' => 'RW',
            'currency_id' => 11,
),
            179 =>
            array (
                'id' => 180,
                'long_name' => 'Saint Kitts and Nevis',
                'short_name' => 'KN',
            'currency_id' => 11,
),
            180 =>
            array (
                'id' => 181,
                'long_name' => 'Saint Lucia',
                'short_name' => 'LC',
            'currency_id' => 11,
),
            181 =>
            array (
                'id' => 182,
                'long_name' => 'Saint Vincent and the Grenadines',
                'short_name' => 'VC',
            'currency_id' => 11,
),
            182 =>
            array (
                'id' => 183,
                'long_name' => 'Samoa',
                'short_name' => 'WS',
            'currency_id' => 11,
),
            183 =>
            array (
                'id' => 184,
                'long_name' => 'San Marino',
                'short_name' => 'SM',
            'currency_id' => 11,
),
            184 =>
            array (
                'id' => 185,
                'long_name' => 'Sao Tome and Principe',
                'short_name' => 'ST',
            'currency_id' => 11,
),
            185 =>
            array (
                'id' => 186,
                'long_name' => 'Saudi Arabia',
                'short_name' => 'SA',
                'currency_id' => 8,
            ),
            186 =>
            array (
                'id' => 187,
                'long_name' => 'Senegal',
                'short_name' => 'SN',
            'currency_id' => 11,
),
            187 =>
            array (
                'id' => 188,
                'long_name' => 'Serbia',
                'short_name' => 'RS',
            'currency_id' => 11,
),
            188 =>
            array (
                'id' => 189,
                'long_name' => 'Seychelles',
                'short_name' => 'SC',
            'currency_id' => 11,
),
            189 =>
            array (
                'id' => 190,
                'long_name' => 'Sierra Leone',
                'short_name' => 'SL',
            'currency_id' => 11,
),
            190 =>
            array (
                'id' => 191,
                'long_name' => 'Singapore',
                'short_name' => 'SG',
            'currency_id' => 11,
),
            191 =>
            array (
                'id' => 192,
                'long_name' => 'Slovakia',
                'short_name' => 'SK',
            'currency_id' => 11,
),
            192 =>
            array (
                'id' => 193,
                'long_name' => 'Slovenia',
                'short_name' => 'SI',
            'currency_id' => 11,
),
            193 =>
            array (
                'id' => 194,
                'long_name' => 'Solomon Islands',
                'short_name' => 'SB',
            'currency_id' => 11,
),
            194 =>
            array (
                'id' => 195,
                'long_name' => 'Somalia',
                'short_name' => 'SO',
            'currency_id' => 11,
),
            195 =>
            array (
                'id' => 196,
                'long_name' => 'South Africa',
                'short_name' => 'ZA',
            'currency_id' => 11,
),
            196 =>
            array (
                'id' => 197,
                'long_name' => 'South Georgia South Sandwich Islands',
                'short_name' => 'GS',
            'currency_id' => 11,
),
            197 =>
            array (
                'id' => 198,
                'long_name' => 'Spain',
                'short_name' => 'ES',
            'currency_id' => 11,
),
            198 =>
            array (
                'id' => 199,
                'long_name' => 'Sri Lanka',
                'short_name' => 'LK',
            'currency_id' => 11,
),
            199 =>
            array (
                'id' => 200,
                'long_name' => 'St. Helena',
                'short_name' => 'SH',
            'currency_id' => 11,
),
            200 =>
            array (
                'id' => 201,
                'long_name' => 'St. Pierre and Miquelon',
                'short_name' => 'PM',
            'currency_id' => 11,
),
            201 =>
            array (
                'id' => 202,
                'long_name' => 'Sudan',
                'short_name' => 'SD',
            'currency_id' => 11,
),
            202 =>
            array (
                'id' => 203,
                'long_name' => 'Suriname',
                'short_name' => 'SR',
            'currency_id' => 11,
),
            203 =>
            array (
                'id' => 204,
                'long_name' => 'Svalbarn and Jan Mayen Islands',
                'short_name' => 'SJ',
            'currency_id' => 11,
),
            204 =>
            array (
                'id' => 205,
                'long_name' => 'Swaziland',
                'short_name' => 'SZ',
            'currency_id' => 11,
),
            205 =>
            array (
                'id' => 206,
                'long_name' => 'Sweden',
                'short_name' => 'SE',
            'currency_id' => 11,
),
            206 =>
            array (
                'id' => 207,
                'long_name' => 'Switzerland',
                'short_name' => 'CH',
            'currency_id' => 11,
),
            207 =>
            array (
                'id' => 208,
                'long_name' => 'Syrian Arab Republic',
                'short_name' => 'SY',
            'currency_id' => 11,
),
            208 =>
            array (
                'id' => 209,
                'long_name' => 'Taiwan',
                'short_name' => 'TW',
            'currency_id' => 11,
),
            209 =>
            array (
                'id' => 210,
                'long_name' => 'Tajikistan',
                'short_name' => 'TJ',
            'currency_id' => 11,
),
            210 =>
            array (
                'id' => 211,
                'long_name' => 'Tanzania, United Republic of',
                'short_name' => 'TZ',
            'currency_id' => 11,
),
            211 =>
            array (
                'id' => 212,
                'long_name' => 'Thailand',
                'short_name' => 'TH',
            'currency_id' => 11,
),
            212 =>
            array (
                'id' => 213,
                'long_name' => 'Togo',
                'short_name' => 'TG',
            'currency_id' => 11,
),
            213 =>
            array (
                'id' => 214,
                'long_name' => 'Tokelau',
                'short_name' => 'TK',
            'currency_id' => 11,
),
            214 =>
            array (
                'id' => 215,
                'long_name' => 'Tonga',
                'short_name' => 'TO',
            'currency_id' => 11,
),
            215 =>
            array (
                'id' => 216,
                'long_name' => 'Trinidad and Tobago',
                'short_name' => 'TT',
            'currency_id' => 11,
),
            216 =>
            array (
                'id' => 217,
                'long_name' => 'Tunisia',
                'short_name' => 'TN',
            'currency_id' => 11,
),
            217 =>
            array (
                'id' => 218,
                'long_name' => 'Turkey',
                'short_name' => 'TR',
            'currency_id' => 11,
),
            218 =>
            array (
                'id' => 219,
                'long_name' => 'Turkmenistan',
                'short_name' => 'TM',
            'currency_id' => 11,
),
            219 =>
            array (
                'id' => 220,
                'long_name' => 'Turks and Caicos Islands',
                'short_name' => 'TC',
            'currency_id' => 11,
),
            220 =>
            array (
                'id' => 221,
                'long_name' => 'Tuvalu',
                'short_name' => 'TV',
            'currency_id' => 11,
),
            221 =>
            array (
                'id' => 222,
                'long_name' => 'Uganda',
                'short_name' => 'UG',
            'currency_id' => 11,
),
            222 =>
            array (
                'id' => 223,
                'long_name' => 'Ukraine',
                'short_name' => 'UA',
            'currency_id' => 11,
),
            223 =>
            array (
                'id' => 224,
                'long_name' => 'United Arab Emirates',
                'short_name' => 'AE',
                'currency_id' => 5,
            ),
            224 =>
            array (
                'id' => 225,
                'long_name' => 'United Kingdom',
                'short_name' => 'GB',
                'currency_id' => 11,
            ),
            225 =>
            array (
                'id' => 226,
                'long_name' => 'United States',
                'short_name' => 'US',
                'currency_id' => 1,
            ),
            226 =>
            array (
                'id' => 227,
                'long_name' => 'United States minor outlying islands',
                'short_name' => 'UM',
                'currency_id' => 1,
            ),
            227 =>
            array (
                'id' => 228,
                'long_name' => 'Uruguay',
                'short_name' => 'UY',
            'currency_id' => 11,
),
            228 =>
            array (
                'id' => 229,
                'long_name' => 'Uzbekistan',
                'short_name' => 'UZ',
            'currency_id' => 11,
),
            229 =>
            array (
                'id' => 230,
                'long_name' => 'Vanuatu',
                'short_name' => 'VU',
            'currency_id' => 11,
),
            230 =>
            array (
                'id' => 231,
                'long_name' => 'Vatican City State',
                'short_name' => 'VA',
            'currency_id' => 11,
),
            231 =>
            array (
                'id' => 232,
                'long_name' => 'Venezuela',
                'short_name' => 'VE',
            'currency_id' => 11,
),
            232 =>
            array (
                'id' => 233,
                'long_name' => 'Vietnam',
                'short_name' => 'VN',
            'currency_id' => 11,
),
            233 =>
            array (
                'id' => 234,
            'long_name' => 'Virgin Islands (British)',
                'short_name' => 'VG',
            'currency_id' => 11,
),
            234 =>
            array (
                'id' => 235,
            'long_name' => 'Virgin Islands (U.S.)',
                'short_name' => 'VI',
            'currency_id' => 11,
),
            235 =>
            array (
                'id' => 236,
                'long_name' => 'Wallis and Futuna Islands',
                'short_name' => 'WF',
            'currency_id' => 11,
),
            236 =>
            array (
                'id' => 237,
                'long_name' => 'Western Sahara',
                'short_name' => 'EH',
            'currency_id' => 11,
),
            237 =>
            array (
                'id' => 238,
                'long_name' => 'Yemen',
                'short_name' => 'YE',
                'currency_id' => 9,
            ),
            238 =>
            array (
                'id' => 239,
                'long_name' => 'Yugoslavia',
                'short_name' => 'YU',
            'currency_id' => 11,
),
            239 =>
            array (
                'id' => 240,
                'long_name' => 'Zaire',
                'short_name' => 'ZR',
            'currency_id' => 11,
),
            240 =>
            array (
                'id' => 241,
                'long_name' => 'Zambia',
                'short_name' => 'ZM',
            'currency_id' => 11,
),
            241 =>
            array (
                'id' => 242,
                'long_name' => 'Zimbabwe',
                'short_name' => 'ZW',
            'currency_id' => 11,
),
            242 =>
            array (
                'id' => 243,
                'long_name' => 'Nothing',
                'short_name' => 'Nothing',
            'currency_id' => 11,
),
        ));


    }
}
