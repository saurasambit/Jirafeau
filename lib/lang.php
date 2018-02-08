<?php
/*
 *  Jirafeau, your web file repository
 *  Copyright (C) 2015  Jerome Jutteau <j.jutteau@gmail.com>
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as
 *  published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

global $languages_list;
$languages_list = array('auto' => 'Automatic',
                         'de'   => 'Deutsch',
                         'en'   => 'English',
                         'el'   => 'Ελληνικά',
                         'es'   => 'Español',
                         'hu'   => 'Magyar',
                         'fi'   => 'Suomi',
                         'fr'   => 'Français',
                         'it'   => 'Italiano',
                         'nl'   => 'Nederlands',
                         'pl'   => 'Polszczyzna',
                         'pt'   => 'português',
                         'pt_BR'   => 'português (Brasil)',
                         'ro'   => 'Limba română',
                         'ru'   => 'ру́сский',
                         'sk'   => 'Slovenčina',
                         'tr'   => 'Türkçe',
                         'zh'   => '汉语');

function t($string_id)
{
    $r = t_in($string_id, t_select_lang());
    if ($r === false) {
        $r = t_in($string_id, "en");
        if ($r === false) {
            return "FIX ME: " . $string_id;
        }
    }
    return $r;
}

function t_select_lang() {
    $cfg = $GLOBALS['cfg'];
    if (strcmp($cfg['lang'], 'auto') != 0) {
        return $cfg['lang'];
    }
    else if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    } else {
        return "en";
    }
}

function t_in($string_id, $lang) {
    $trans = t_get_json($lang);
    if ($trans === false) {
        return false;
    }
    if (!array_key_exists($string_id, $trans)) {
        return false;
    }
    return $trans[$string_id];
}

function t_get_raw_json($lang) {
    $p = JIRAFEAU_ROOT . "lib/locales/$lang.json";
    if (!file_exists($p)) {
        return false;
    }
    $json = file_get_contents($p);
    if ($json === false) {
        return false;
    }
    return $json;
}

function t_get_json($lang) {
    $raw_j = t_get_raw_json($lang);
    $array = json_decode($raw_j, true);
    if ($array === null) {
        return false;
    }
    return $array;
}

function json_lang_generator($lang) {
    $r = "";
    if ($lang === null) {
        $r = t_get_raw_json(t_select_lang());
    } else {
        $r = t_get_raw_json($lang);
    }
    return $r === false ? "{}" : $r;
}
