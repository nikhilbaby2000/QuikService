<?php

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Debug\Dumper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use App\QuikService\SMSTemplate\SMSTemplate;
use App\QuikService\Libraries\QueryFilter\FilterContract;
use App\QuikService\Services\OTP\Generator\OTPGeneratorContract;

/**
 * Custom helper functions.
 */

if (! function_exists('uuid')) {
    /**
     * Generate Uuid string.
     *
     * @return string
     */
    function uuid()
    {
        return Uuid::uuid4()->toString();
    }
}

if (! function_exists('is_valid_uuid')) {
    /**
     * Check if the UUID is valid.
     *
     * @param string $uuid
     * @return bool
     */
    function is_valid_uuid($uuid)
    {
        return Uuid::isValid($uuid);
    }
}

if (! function_exists('generate_otp')) {
    /**
     * Generate a random OTP.
     *
     * @param int|null $length Default value is 6 | Maximum value is 9
     * @return string
     */
    function generate_otp($length = null)
    {
        return app(OTPGeneratorContract::class)->generate($length);
    }
}

if (! function_exists('is_valid_mobile_number')) {
    /**
     * Check if the mobile number is valid.
     *
     * @param string $mobile
     * @return bool
     */
    function is_valid_mobile_number($mobile)
    {
        return preg_match('/^[0-9]{10}+$/', $mobile);
    }
}

if (! function_exists('is_valid_email')) {
    /**
     * Check if the email address is valid.
     *
     * @param string $email
     * @return bool
     */
    function is_valid_email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}

if (! function_exists('is_valid_date')) {
    /**
     * Validate the date time string and return the Carbon instance if needed.
     *
     * @param string $date
     * @param bool $returnDate
     * @return bool|\Carbon\Carbon
     */
    function is_valid_date($date, $returnDate = true)
    {
        if (Validator::make(['date' => $date], ['date' => 'required|date'])->fails()) {
            return false;
        }

        return $returnDate ? Carbon::parse($date) : true;
    }
}

if (! function_exists('amount_in_words')) {
    /**
     * Return amount in words.
     *
     * @param number $amount
     * @return string
     */
    function amount_in_words($amount)
    {
        return (new NumberFormatter("en", NumberFormatter::SPELLOUT))->format($amount);
    }
}

if (! function_exists('hash_check')) {
    /**
     * Check the given plain value against a hash.
     *
     * @param  string  $value
     * @param  string  $hashedValue
     * @return bool
     */
    function hash_check($value, $hashedValue)
    {
        return app('hash')->check($value, $hashedValue);
    }
}

if (! function_exists('access')) {
    /**
     * Get the singleton Access instance.
     *
     * @param string|null $guard
     * @return App\QuikService\Libraries\Access\Access
     */
    function access($guard = null)
    {
        $access = app('access');

        if (is_null($guard)) {
            return $access;
        }

        return $access->guard($guard);
    }
}

if (! function_exists('sms')) {
    /**
     * Get the SMS sender instance.
     *
     * @param string|array|null $numbers
     * @param string|null $message
     * @param int|null $type
     * @return \App\QuikService\Libraries\SMS\SMS
     */
    function sms($numbers = null, $message = null, $type = null)
    {
        return app('sms')->to($numbers)->message($message)->type($type);
    }
}

if (! function_exists('sms_template')) {
    /**
     * Get the message generated using the SMS template.
     *
     * @param string $name
     * @param array $replace
     * @param string|null $locale
     * @return string
     */
    function sms_template($name, array $replace = [], $locale = null)
    {
        return (new SMSTemplate($name, $replace, $locale))->getMessage();
    }
}

if (! function_exists('filter')) {
    /**
     * Get the Query String Filter instance.
     *
     * @param \Illuminate\Database\Eloquent\Builder|null $builder
     * @param \League\Fractal\TransformerAbstract|callable|null $transformer
     * @param App\QuikService\Libraries\QueryFilter\FilterContract|null $customFilter
     * @return App\QuikService\Libraries\QueryFilter\QueryFilter
     */
    function filter(Builder $builder = null, $transformer = null, FilterContract $customFilter = null)
    {
        $queryFilter = app('query-filter');

        if (!is_null($builder)) {
            $queryFilter = $queryFilter->builder($builder);
        }

        if (!is_null($transformer)) {
            $queryFilter = $queryFilter->transformWith($transformer);
        }

        if (!is_null($customFilter)) {
            $queryFilter = $queryFilter->customFilter($customFilter);
        }

        return $queryFilter;
    }
}

//if (! function_exists('hash_generator')) {
//    /**
//     * Get the hash generator instance or the hash (with arguments).
//     *
//     * @param int|null $length
//     * @param string|null $prefix
//     * @param string|null $suffix
//     * @param string|null $extension
//     * @return HashGeneratorContract|\Illuminate\Foundation\Application|mixed|string
//     */
//    function hash_generator($length = null, $prefix = null, $suffix = null, $extension = null)
//    {
//        $hashGenerator = app(HashGeneratorContract::class);
//
//        if (func_num_args() === 0) {
//            return $hashGenerator;
//        }
//
//        return $hashGenerator->make($length, $prefix, $suffix, $extension);
//    }
//}

if (! function_exists('custom_date_dmy')) {
    /**
     * Get formatted time in the 'd M, Y' format.
     * @param string $date
     * @return false|string
     */
    function custom_date_dmy(string $date)
    {
        if (empty($date)) {
            return '';
        }

        return Carbon::createFromTimestamp(strtotime($date))->format('d M, Y');
    }
}

if (! function_exists('is_valid_json')) {
    /**
     * Check if the input is a valid JSON data.
     *
     * @param string $dataString
     * @param bool $isObjectOrArray
     * @return bool
     */
    function is_valid_json(string $dataString, bool $isObjectOrArray = false)
    {
        $decoded = json_decode($dataString);
        $isValidJson = (!empty($decoded) ? true : false) && json_last_error() == JSON_ERROR_NONE;
        if ($isValidJson && $isObjectOrArray) {
            return !is_int($decoded);
        }

        return $isValidJson;
    }
}

if (! function_exists('is_cache_taggable')) {
    /**
     * Check if the current cache store supports tagging.
     * Run the provided closure function if tagging is supported.
     *
     * @param Closure|null $closure
     * @return bool|mixed
     */
    function is_cache_taggable(Closure $closure = null)
    {
        if (Cache::getStore() instanceof TaggableStore) {
            return $closure ? $closure() : true;
        }

        return false;
    }
}

if (! function_exists('model_cache_tag')) {
    /**
     * Get the model's cache tag.
     * Manually add another tag to the tag list if provided.
     *
     * @param Model $model
     * @param string|mixed $additionalTag
     * @return array|string
     */
    function model_cache_tag(Model $model, $additionalTag = null)
    {
        $tag = 'model_' . $model->getTable();

        if ($additionalTag && is_string($additionalTag)) {
            return [$tag, $additionalTag];
        }

        return $tag;
    }
}

if (! function_exists('model_cache_key')) {
    /**
     * Generate a unique cache key for the model using the primary key.
     *
     * @param Model $model
     * @return string
     */
    function model_cache_key(Model $model)
    {
        return "model_{$model->getTable()}_{$model->getKey()}";
    }
}

if (! function_exists('flush_model_cache')) {
    /**
     * Flush the model's tagged cache.
     *
     * @param Model $model
     * @return bool|mixed
     */
    function flush_model_cache(Model $model)
    {
        return is_cache_taggable(function () use ($model) {
            Cache::tags(model_cache_tag($model))->flush();
        });
    }
}

if (! function_exists('app_environment')) {
    /**
     * Get or check the current application environment.
     *
     * @param mixed $args
     * @return bool|string
     */
    function app_environment(...$args)
    {
        return app()->environment(...$args);
    }
}

if (! function_exists('app_debug_enabled')) {
    /**
     * Check if the app debug is enabled.
     *
     * @return bool
     */
    function app_debug_enabled()
    {
        return config('app.debug', false);
    }
}

if (! function_exists('app_debug_disabled')) {
    /**
     * Check if the app debug is disabled.
     *
     * @return bool
     */
    function app_debug_disabled()
    {
        return !app_debug_enabled();
    }
}

if (! function_exists('now')) {
    /**
     * Get a Carbon instance for the current time.
     *
     * @param \DateTimeZone|string|null $tz
     * @return \Carbon\Carbon
     */
    function now($tz = null)
    {
        return Carbon::now($tz);
    }
}

if (! function_exists('today')) {
    /**
     * Get a Carbon instance for the current date.
     *
     * @param \DateTimeZone|string|null $tz
     * @return \Carbon\Carbon
     */
    function today($tz = null)
    {
        return Carbon::today($tz);
    }
}

if (! function_exists('tomorrow')) {
    /**
     * Get a Carbon instance for tomorrow.
     *
     * @param \DateTimeZone|string|null $tz
     * @return \Carbon\Carbon
     */
    function tomorrow($tz = null)
    {
        return Carbon::tomorrow($tz);
    }
}

if (! function_exists('to_carbon')) {
    /**
     * Create a carbon instance from a string.
     *
     * @param string $time
     * @return \Carbon\Carbon
     */
    function to_carbon($time)
    {
        return Carbon::parse($time);
    }
}

if (! function_exists('format_appointment_slot')) {
    /**
     * Format appointment time slot.
     *
     * @param \Carbon\Carbon $from
     * @param \Carbon\Carbon $to
     * @return string
     */
    function format_appointment_slot($from, $to)
    {
        return $from->format('h:i A') . ' to ' . $to->format('h:i A');
    }
}

if (! function_exists('ip')) {
    /**
     * Get the client IP address.
     *
     * @return string
     */
    function ip()
    {
        return request()->ip();
    }
}

if (! function_exists('array_has_all')) {
    /**
     * Check if an array contains all the searched array values.
     *
     * @param array $search The array values used to search
     * @param array $haystack The main array on which the search is performed
     * @return bool
     */
    function array_has_all(array $search, array $haystack)
    {
        if (empty($search)) {
            return false;
        }

        return !array_diff($search, $haystack);
    }
}

if (! function_exists('file_path')) {
    /**
     * Get the full file path given the folder path and file name.
     *
     * @param string $path
     * @param string $filename
     * @param string $folder The folder inside the path
     * @return string
     */
    function file_path($path, $filename, $folder = null)
    {
        return rtrim($path, '/') . ($folder ? "/{$folder}/" : '/') . $filename;
    }
}

if (! function_exists('folder_merge')) {
    /**
     * Get the full folder path after merging all the provided paths.
     *
     * @param array $folders The folders to merge
     * @return string
     */
    function folder_merge(...$folders)
    {
        return array_reduce($folders, function ($result, $folder) {
            return $result . trim($folder, '/') . '/';
        });
    }
}

if (! function_exists('string_clean')) {
    /**
     * Trim and convert the string to lower case.
     *
     * @param string $value
     * @return string
     */
    function string_clean($value)
    {
        return mb_strtolower(trim($value));
    }
}

if (! function_exists('string_replacer')) {
    /**
     * Replace all the placeholders with their values defined by the replacer array.
     *
     * @param string $subject
     * @param array $replace
     * @return string
     */
    function string_replacer($subject, array $replace)
    {
        if (empty($replace)) {
            return $subject;
        }

        foreach ($replace as $key => $value) {
            $subject = preg_replace("/:{$key}\b/i", (string) $value, $subject);
        }

        return $subject;
    }
}

if (! function_exists('string_before')) {
    /**
     * Get the portion of a string before a given value.
     *
     * @param string $subject
     * @param string $search
     * @return string
     */
    function string_before($subject, $search)
    {
        return $search === '' ? $subject : explode($search, $subject)[0];
    }
}

if (! function_exists('clean_url')) {
    /**
     * Build the clean url using the main and path.
     * The path gets cleaned if it contains any domain info.
     *
     * @param string $url
     * @param string $path
     * @return string
     */
    function clean_url($url, $path)
    {
        $parsedPath = parse_url($path);

        $path = isset($parsedPath['path'])
            ? $parsedPath['path']
            : '/';

        return URL::format($url, $path);
    }
}

if (! function_exists('array_merge_when')) {
    /**
     * Merge an array with another based on the given "value".
     *
     * @param mixed $value
     * @param array $array
     * @param array $addOnTrueArray
     * @param array $addOnFalseArray
     * @return array
     */
    function array_merge_when($value, array &$array, array $addOnTrueArray, array $addOnFalseArray = [])
    {
        $array = array_merge($array, $value ? $addOnTrueArray : $addOnFalseArray);

        return $array;
    }
}

if (! function_exists('role_middleware')) {
    /**
     * Generate the role middleware string.
     *
     * @param string|array $roles
     * @param bool $requireAll
     * @param string $middlewareName
     * @return string
     */
    function role_middleware($roles, $requireAll = false, $middlewareName = 'role')
    {
        $string = $middlewareName . ':' . implode('|', array_wrap($roles));

        return $requireAll ? $string . ',true' : $string;
    }
}

if (! function_exists('perm_middleware')) {
    /**
     * Generate the permission middleware string.
     *
     * @param string|array $permissions
     * @param bool $requireAll
     * @param string $middlewareName
     * @return string
     */
    function perm_middleware($permissions, $requireAll = false, $middlewareName = 'permission')
    {
        $string = $middlewareName . ':' . implode('|', array_wrap($permissions));

        return $requireAll ? $string . ',true' : $string;
    }
}

if (! function_exists('limit_value')) {
    /**
     * Limit the given input value between the min and max value.
     *
     * @param mixed $value
     * @param mixed $min
     * @param mixed $max
     * @return mixed
     */
    function limit_value($value, $min, $max)
    {
        return min(max($value, $min), $max);
    }
}

if (! function_exists('prettify')) {
    /**
     * Prettify the given value.
     *
     * Sample result:
     *  name            Name
     *  age             Age
     *  created_at      Created At
     *  totalAmount     Total Amount
     *  birth_date      Birth Date
     *  theirPetName    Their Pet Name
     *  some-value      Some Value
     *
     * @param string $value
     * @return string
     */
    function prettify($value)
    {
        return title_case(snake_case(camel_case($value), ' '));
    }
}

if (! function_exists('execute_and_ignore_exception')) {

    /**
     * Execute a block of code and ignore any exception thrown.
     * Optionally pass a closure to be executed if an exception arises.
     *
     * @param Closure $closure
     * @param Closure|null $catch
     * @param mixed|null $default
     * @return mixed|null
     */
    function execute_and_ignore_exception(Closure $closure, Closure $catch = null, $default = null)
    {
        try {
            return $closure();
        } catch (Exception $e) {
            if ($catch) {
                return $catch($e);
            }
        }

        return $default;
    }
}

if (! function_exists('array_to_object')) {
    /**
     * Convert an array to object.
     *
     * @param array $array
     * @param bool $recursive
     * @return object
     */
    function array_to_object(array $array, $recursive = true)
    {
        return json_decode(json_encode($array, $recursive ? JSON_FORCE_OBJECT : 0));
    }
}

if (! function_exists('include_route_files')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param string $folder
     */
    function include_route_files($folder)
    {
        $path = base_path('routes'. DIRECTORY_SEPARATOR . $folder);
        $rdi = new recursiveDirectoryIterator($path);
        $it = new recursiveIteratorIterator($rdi);

        while ($it->valid()) {
            if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                require $it->key();
            }

            $it->next();
        }
    }
}

if (! function_exists('resolve_boolean')) {

    /**
     * Resolves a string towards a boolean value.
     *
     * @param $value
     * @return bool
     */
    function resolve_boolean($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}

if (! function_exists('command')) {

    /**
     * Call an Artisan command.
     *
     * @param string $command
     * @param array $parameters
     * @param null $outputBuffer
     * @return bool
     */
    function command(string $command, array $parameters = [], $outputBuffer = null)
    {
        return \Artisan::call($command, $parameters, $outputBuffer);
    }
}

if (! function_exists('slug')) {

    /**
     * Generates slug of the given string.
     *
     * @param $string
     * @param string $separator
     * @param string $language
     * @return string
     */
    function slug($string, $separator = '-', $language = 'en')
    {
        return str_slug($string, $separator, $language);
    }
}

if (! function_exists('flash')) {

    /**
     * Flashes the session with the given values.
     *
     * @param array $messages
     * @return string
     */
    function flash($messages = [])
    {
        foreach ($messages as $key => $message) {
            Session::flash($key, $message);
        }
    }
}

if (! function_exists('get_flash')) {

    /**
     * Get Flash value.
     *
     * @param $key
     * @param $default
     * @return string
     */
    function get_flash($key, $default = null)
    {
        return session($key, $default);
    }
}

if (! function_exists('substr_exist')) {

    /**
     * Get Flash value.
     *
     * @param $haystack
     * @param $needle
     * @param bool $case_insensitive
     * @return bool
     */
    function substr_exist($haystack, $needle, $case_insensitive = true)
    {
        return $case_insensitive
            ? !is_bool(strpos(strtolower($haystack), strtolower($needle)))
            : !is_bool(strpos($haystack, $needle));
    }
}

if (! function_exists('p')) {
    /**
     * Dump the passed variables and continue the script.
     *
     * @param  mixed  $args
     * @return void
     */
    function p(...$args)
    {
        http_response_code(500);

        foreach ($args as $x) {
            (new Dumper)->dump($x);
        }
    }
}