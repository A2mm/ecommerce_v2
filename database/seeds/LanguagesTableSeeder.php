<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'long_name' => 'English',
                'short_name' => 'EN',
            ),
            1 => 
            array (
                'id' => 2,
                'long_name' => 'Afar',
                'short_name' => 'aa',
            ),
            2 => 
            array (
                'id' => 3,
                'long_name' => 'Abkhazian',
                'short_name' => 'ab',
            ),
            3 => 
            array (
                'id' => 4,
                'long_name' => 'Afrikaans',
                'short_name' => 'af',
            ),
            4 => 
            array (
                'id' => 5,
                'long_name' => 'Amharic',
                'short_name' => 'am',
            ),
            5 => 
            array (
                'id' => 6,
                'long_name' => 'Arabic',
                'short_name' => 'ar',
            ),
            6 => 
            array (
                'id' => 7,
                'long_name' => 'Assamese',
                'short_name' => 'as',
            ),
            7 => 
            array (
                'id' => 8,
                'long_name' => 'Aymara',
                'short_name' => 'ay',
            ),
            8 => 
            array (
                'id' => 9,
                'long_name' => 'Azerbaijani',
                'short_name' => 'az',
            ),
            9 => 
            array (
                'id' => 10,
                'long_name' => 'Bashkir',
                'short_name' => 'ba',
            ),
            10 => 
            array (
                'id' => 11,
                'long_name' => 'Byelorussian',
                'short_name' => 'be',
            ),
            11 => 
            array (
                'id' => 12,
                'long_name' => 'Bulgarian',
                'short_name' => 'bg',
            ),
            12 => 
            array (
                'id' => 13,
                'long_name' => 'Bihari',
                'short_name' => 'bh',
            ),
            13 => 
            array (
                'id' => 14,
                'long_name' => 'Bislama',
                'short_name' => 'bi',
            ),
            14 => 
            array (
                'id' => 15,
                'long_name' => 'Bengali/Bangla',
                'short_name' => 'bn',
            ),
            15 => 
            array (
                'id' => 16,
                'long_name' => 'Tibetan',
                'short_name' => 'bo',
            ),
            16 => 
            array (
                'id' => 17,
                'long_name' => 'Breton',
                'short_name' => 'br',
            ),
            17 => 
            array (
                'id' => 18,
                'long_name' => 'Catalan',
                'short_name' => 'ca',
            ),
            18 => 
            array (
                'id' => 19,
                'long_name' => 'Corsican',
                'short_name' => 'co',
            ),
            19 => 
            array (
                'id' => 20,
                'long_name' => 'Czech',
                'short_name' => 'cs',
            ),
            20 => 
            array (
                'id' => 21,
                'long_name' => 'Welsh',
                'short_name' => 'cy',
            ),
            21 => 
            array (
                'id' => 22,
                'long_name' => 'Danish',
                'short_name' => 'da',
            ),
            22 => 
            array (
                'id' => 23,
                'long_name' => 'German',
                'short_name' => 'de',
            ),
            23 => 
            array (
                'id' => 24,
                'long_name' => 'Bhutani',
                'short_name' => 'dz',
            ),
            24 => 
            array (
                'id' => 25,
                'long_name' => 'Greek',
                'short_name' => 'el',
            ),
            25 => 
            array (
                'id' => 26,
                'long_name' => 'Esperanto',
                'short_name' => 'eo',
            ),
            26 => 
            array (
                'id' => 27,
                'long_name' => 'Spanish',
                'short_name' => 'es',
            ),
            27 => 
            array (
                'id' => 28,
                'long_name' => 'Estonian',
                'short_name' => 'et',
            ),
            28 => 
            array (
                'id' => 29,
                'long_name' => 'Basque',
                'short_name' => 'eu',
            ),
            29 => 
            array (
                'id' => 30,
                'long_name' => 'Persian',
                'short_name' => 'fa',
            ),
            30 => 
            array (
                'id' => 31,
                'long_name' => 'Finnish',
                'short_name' => 'fi',
            ),
            31 => 
            array (
                'id' => 32,
                'long_name' => 'Fiji',
                'short_name' => 'fj',
            ),
            32 => 
            array (
                'id' => 33,
                'long_name' => 'Faeroese',
                'short_name' => 'fo',
            ),
            33 => 
            array (
                'id' => 34,
                'long_name' => 'French',
                'short_name' => 'fr',
            ),
            34 => 
            array (
                'id' => 35,
                'long_name' => 'Frisian',
                'short_name' => 'fy',
            ),
            35 => 
            array (
                'id' => 36,
                'long_name' => 'Irish',
                'short_name' => 'ga',
            ),
            36 => 
            array (
                'id' => 37,
                'long_name' => 'Scots/Gaelic',
                'short_name' => 'gd',
            ),
            37 => 
            array (
                'id' => 38,
                'long_name' => 'Galician',
                'short_name' => 'gl',
            ),
            38 => 
            array (
                'id' => 39,
                'long_name' => 'Guarani',
                'short_name' => 'gn',
            ),
            39 => 
            array (
                'id' => 40,
                'long_name' => 'Gujarati',
                'short_name' => 'gu',
            ),
            40 => 
            array (
                'id' => 41,
                'long_name' => 'Hausa',
                'short_name' => 'ha',
            ),
            41 => 
            array (
                'id' => 42,
                'long_name' => 'Hindi',
                'short_name' => 'hi',
            ),
            42 => 
            array (
                'id' => 43,
                'long_name' => 'Croatian',
                'short_name' => 'hr',
            ),
            43 => 
            array (
                'id' => 44,
                'long_name' => 'Hungarian',
                'short_name' => 'hu',
            ),
            44 => 
            array (
                'id' => 45,
                'long_name' => 'Armenian',
                'short_name' => 'hy',
            ),
            45 => 
            array (
                'id' => 46,
                'long_name' => 'Interlingua',
                'short_name' => 'ia',
            ),
            46 => 
            array (
                'id' => 47,
                'long_name' => 'Interlingue',
                'short_name' => 'ie',
            ),
            47 => 
            array (
                'id' => 48,
                'long_name' => 'Inupiak',
                'short_name' => 'ik',
            ),
            48 => 
            array (
                'id' => 49,
                'long_name' => 'Indonesian',
                'short_name' => 'in',
            ),
            49 => 
            array (
                'id' => 50,
                'long_name' => 'Icelandic',
                'short_name' => 'is',
            ),
            50 => 
            array (
                'id' => 51,
                'long_name' => 'Italian',
                'short_name' => 'it',
            ),
            51 => 
            array (
                'id' => 52,
                'long_name' => 'Hebrew',
                'short_name' => 'iw',
            ),
            52 => 
            array (
                'id' => 53,
                'long_name' => 'Japanese',
                'short_name' => 'ja',
            ),
            53 => 
            array (
                'id' => 54,
                'long_name' => 'Yiddish',
                'short_name' => 'ji',
            ),
            54 => 
            array (
                'id' => 55,
                'long_name' => 'Javanese',
                'short_name' => 'jw',
            ),
            55 => 
            array (
                'id' => 56,
                'long_name' => 'Georgian',
                'short_name' => 'ka',
            ),
            56 => 
            array (
                'id' => 57,
                'long_name' => 'Kazakh',
                'short_name' => 'kk',
            ),
            57 => 
            array (
                'id' => 58,
                'long_name' => 'Greenlandic',
                'short_name' => 'kl',
            ),
            58 => 
            array (
                'id' => 59,
                'long_name' => 'Cambodian',
                'short_name' => 'km',
            ),
            59 => 
            array (
                'id' => 60,
                'long_name' => 'Kannada',
                'short_name' => 'kn',
            ),
            60 => 
            array (
                'id' => 61,
                'long_name' => 'Korean',
                'short_name' => 'ko',
            ),
            61 => 
            array (
                'id' => 62,
                'long_name' => 'Kashmiri',
                'short_name' => 'ks',
            ),
            62 => 
            array (
                'id' => 63,
                'long_name' => 'Kurdish',
                'short_name' => 'ku',
            ),
            63 => 
            array (
                'id' => 64,
                'long_name' => 'Kirghiz',
                'short_name' => 'ky',
            ),
            64 => 
            array (
                'id' => 65,
                'long_name' => 'Latin',
                'short_name' => 'la',
            ),
            65 => 
            array (
                'id' => 66,
                'long_name' => 'Lingala',
                'short_name' => 'ln',
            ),
            66 => 
            array (
                'id' => 67,
                'long_name' => 'Laothian',
                'short_name' => 'lo',
            ),
            67 => 
            array (
                'id' => 68,
                'long_name' => 'Lithuanian',
                'short_name' => 'lt',
            ),
            68 => 
            array (
                'id' => 69,
                'long_name' => 'Latvian/Lettish',
                'short_name' => 'lv',
            ),
            69 => 
            array (
                'id' => 70,
                'long_name' => 'Malagasy',
                'short_name' => 'mg',
            ),
            70 => 
            array (
                'id' => 71,
                'long_name' => 'Maori',
                'short_name' => 'mi',
            ),
            71 => 
            array (
                'id' => 72,
                'long_name' => 'Macedonian',
                'short_name' => 'mk',
            ),
            72 => 
            array (
                'id' => 73,
                'long_name' => 'Malayalam',
                'short_name' => 'ml',
            ),
            73 => 
            array (
                'id' => 74,
                'long_name' => 'Mongolian',
                'short_name' => 'mn',
            ),
            74 => 
            array (
                'id' => 75,
                'long_name' => 'Moldavian',
                'short_name' => 'mo',
            ),
            75 => 
            array (
                'id' => 76,
                'long_name' => 'Marathi',
                'short_name' => 'mr',
            ),
            76 => 
            array (
                'id' => 77,
                'long_name' => 'Malay',
                'short_name' => 'ms',
            ),
            77 => 
            array (
                'id' => 78,
                'long_name' => 'Maltese',
                'short_name' => 'mt',
            ),
            78 => 
            array (
                'id' => 79,
                'long_name' => 'Burmese',
                'short_name' => 'my',
            ),
            79 => 
            array (
                'id' => 80,
                'long_name' => 'Nauru',
                'short_name' => 'na',
            ),
            80 => 
            array (
                'id' => 81,
                'long_name' => 'Nepali',
                'short_name' => 'ne',
            ),
            81 => 
            array (
                'id' => 82,
                'long_name' => 'Dutch',
                'short_name' => 'nl',
            ),
            82 => 
            array (
                'id' => 83,
                'long_name' => 'Norwegian',
                'short_name' => 'no',
            ),
            83 => 
            array (
                'id' => 84,
                'long_name' => 'Occitan',
                'short_name' => 'oc',
            ),
            84 => 
            array (
                'id' => 85,
            'long_name' => '(Afan)/Oromoor/Oriya',
                'short_name' => 'om',
            ),
            85 => 
            array (
                'id' => 86,
                'long_name' => 'Punjabi',
                'short_name' => 'pa',
            ),
            86 => 
            array (
                'id' => 87,
                'long_name' => 'Polish',
                'short_name' => 'pl',
            ),
            87 => 
            array (
                'id' => 88,
                'long_name' => 'Pashto/Pushto',
                'short_name' => 'ps',
            ),
            88 => 
            array (
                'id' => 89,
                'long_name' => 'Portuguese',
                'short_name' => 'pt',
            ),
            89 => 
            array (
                'id' => 90,
                'long_name' => 'Quechua',
                'short_name' => 'qu',
            ),
            90 => 
            array (
                'id' => 91,
                'long_name' => 'Rhaeto-Romance',
                'short_name' => 'rm',
            ),
            91 => 
            array (
                'id' => 92,
                'long_name' => 'Kirundi',
                'short_name' => 'rn',
            ),
            92 => 
            array (
                'id' => 93,
                'long_name' => 'Romanian',
                'short_name' => 'ro',
            ),
            93 => 
            array (
                'id' => 94,
                'long_name' => 'Russian',
                'short_name' => 'ru',
            ),
            94 => 
            array (
                'id' => 95,
                'long_name' => 'Kinyarwanda',
                'short_name' => 'rw',
            ),
            95 => 
            array (
                'id' => 96,
                'long_name' => 'Sanskrit',
                'short_name' => 'sa',
            ),
            96 => 
            array (
                'id' => 97,
                'long_name' => 'Sindhi',
                'short_name' => 'sd',
            ),
            97 => 
            array (
                'id' => 98,
                'long_name' => 'Sangro',
                'short_name' => 'sg',
            ),
            98 => 
            array (
                'id' => 99,
                'long_name' => 'Serbo-Croatian',
                'short_name' => 'sh',
            ),
            99 => 
            array (
                'id' => 100,
                'long_name' => 'Singhalese',
                'short_name' => 'si',
            ),
            100 => 
            array (
                'id' => 101,
                'long_name' => 'Slovak',
                'short_name' => 'sk',
            ),
            101 => 
            array (
                'id' => 102,
                'long_name' => 'Slovenian',
                'short_name' => 'sl',
            ),
            102 => 
            array (
                'id' => 103,
                'long_name' => 'Samoan',
                'short_name' => 'sm',
            ),
            103 => 
            array (
                'id' => 104,
                'long_name' => 'Shona',
                'short_name' => 'sn',
            ),
            104 => 
            array (
                'id' => 105,
                'long_name' => 'Somali',
                'short_name' => 'so',
            ),
            105 => 
            array (
                'id' => 106,
                'long_name' => 'Albanian',
                'short_name' => 'sq',
            ),
            106 => 
            array (
                'id' => 107,
                'long_name' => 'Serbian',
                'short_name' => 'sr',
            ),
            107 => 
            array (
                'id' => 108,
                'long_name' => 'Siswati',
                'short_name' => 'ss',
            ),
            108 => 
            array (
                'id' => 109,
                'long_name' => 'Sesotho',
                'short_name' => 'st',
            ),
            109 => 
            array (
                'id' => 110,
                'long_name' => 'Sundanese',
                'short_name' => 'su',
            ),
            110 => 
            array (
                'id' => 111,
                'long_name' => 'Swedish',
                'short_name' => 'sv',
            ),
            111 => 
            array (
                'id' => 112,
                'long_name' => 'Swahili',
                'short_name' => 'sw',
            ),
            112 => 
            array (
                'id' => 113,
                'long_name' => 'Tamil',
                'short_name' => 'ta',
            ),
            113 => 
            array (
                'id' => 114,
                'long_name' => 'Tegulu',
                'short_name' => 'te',
            ),
            114 => 
            array (
                'id' => 115,
                'long_name' => 'Tajik',
                'short_name' => 'tg',
            ),
            115 => 
            array (
                'id' => 116,
                'long_name' => 'Thai',
                'short_name' => 'th',
            ),
            116 => 
            array (
                'id' => 117,
                'long_name' => 'Tigrinya',
                'short_name' => 'ti',
            ),
            117 => 
            array (
                'id' => 118,
                'long_name' => 'Turkmen',
                'short_name' => 'tk',
            ),
            118 => 
            array (
                'id' => 119,
                'long_name' => 'Tagalog',
                'short_name' => 'tl',
            ),
            119 => 
            array (
                'id' => 120,
                'long_name' => 'Setswana',
                'short_name' => 'tn',
            ),
            120 => 
            array (
                'id' => 121,
                'long_name' => 'Tonga',
                'short_name' => 'to',
            ),
            121 => 
            array (
                'id' => 122,
                'long_name' => 'Turkish',
                'short_name' => 'tr',
            ),
            122 => 
            array (
                'id' => 123,
                'long_name' => 'Tsonga',
                'short_name' => 'ts',
            ),
            123 => 
            array (
                'id' => 124,
                'long_name' => 'Tatar',
                'short_name' => 'tt',
            ),
            124 => 
            array (
                'id' => 125,
                'long_name' => 'Twi',
                'short_name' => 'tw',
            ),
            125 => 
            array (
                'id' => 126,
                'long_name' => 'Ukrainian',
                'short_name' => 'uk',
            ),
            126 => 
            array (
                'id' => 127,
                'long_name' => 'Urdu',
                'short_name' => 'ur',
            ),
            127 => 
            array (
                'id' => 128,
                'long_name' => 'Uzbek',
                'short_name' => 'uz',
            ),
            128 => 
            array (
                'id' => 129,
                'long_name' => 'Vietnamese',
                'short_name' => 'vi',
            ),
            129 => 
            array (
                'id' => 130,
                'long_name' => 'Volapuk',
                'short_name' => 'vo',
            ),
            130 => 
            array (
                'id' => 131,
                'long_name' => 'Wolof',
                'short_name' => 'wo',
            ),
            131 => 
            array (
                'id' => 132,
                'long_name' => 'Xhosa',
                'short_name' => 'xh',
            ),
            132 => 
            array (
                'id' => 133,
                'long_name' => 'Yoruba',
                'short_name' => 'yo',
            ),
            133 => 
            array (
                'id' => 134,
                'long_name' => 'Chinese',
                'short_name' => 'zh',
            ),
            134 => 
            array (
                'id' => 135,
                'long_name' => 'Zulu',
                'short_name' => 'zu',
            ),
        ));
        
        
    }
}