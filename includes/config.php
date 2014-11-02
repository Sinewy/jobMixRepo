<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 11/2/14
 * Time: 10:59 AM
 */

define("DB_HOST",   "localhost");
define("DB_USER",   "pi");
define("DB_PASS",   "jagode4");
define("DB_NAME",   "jumixGuiRPi");

define("API_PATH", "http://10.20.0.101:8000/api/v1");
define("API_MIXER_DATA", API_PATH."/mixers");
define("API_DEVICE_INFO", API_MIXER_DATA."/info");
define("API_LANGUAGES", API_PATH."/languages");
define("API_ACTIVATE", API_PATH."/activate");
define("API_DEACTIVATE_DEVICE", API_PATH."/deactivate");

