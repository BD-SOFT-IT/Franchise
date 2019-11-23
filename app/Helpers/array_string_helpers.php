<?php
// Helper Functions For Array or String
use App\Models\DeliveryLocation;
use EasyBanglaDate\Types\BnDateTime;
use EasyBanglaDate\Types\DateTime as EnDateTime;
use Illuminate\Database\Eloquent\Model;


/**
 * @param Model|string $model
 * @param string $attribute
 * @param string $source_en
 * @param string|null $source_bn
 * @param string $separator
 * @return string
 */
function createSlug($model, string $attribute, string $source_en, string $source_bn = null, string $separator = '-') : string {
    if(is_string($model)) {
        $model = new $model;
    }
    if(!Schema::hasColumn($model->getTable(), $attribute)) {
        $modelClass = get_class($model);
        throw new \InvalidArgumentException("Argument 2 passed to createSlug ['{$attribute}'] is not a valid slug attribute for model '{$modelClass}'.");
    }

    $src_en = iconv('utf-8', 'us-ascii//TRANSLIT', $source_en);
    $src = strtolower($src_en);
    if($source_bn) {
        $src .= $separator . $source_bn;
    }

    $created_slug = preg_replace('![^\p{L}\p{N}\p{Bengali}]!u', ' ', $src);
    $created_slug = preg_replace('/\s+/u', '-', trim($created_slug));

    $existing = $model->where($attribute, 'LIKE', "%$created_slug%")
        ->select($model->getTable() . '.' . $attribute)
        ->get();

    $slug = $created_slug;

    if($existing) {
        $existing_slugs = [];
        foreach($existing as $item) {
            array_push($existing_slugs, $item->$attribute);
        }

        $n = 1;
        while(1) {
            if(!in_array($slug, $existing_slugs)) {
                break;
            }
            $slug = $created_slug . $separator . $n;
            $n++;
        }
    }
    if(mb_substr($slug, -1, 1) == $separator) {
        $slug = Str::replaceLast($separator, '', $slug);
    }
    return $slug;
}

/**
 * @param array $data
 * @param bool $multi
 * @return string
 */
function convertArrayToString(array $data, bool $multi = false) : string {
    $output = '';

    if(!$multi) {
        $count = 1;
        $total = count($data);

        foreach($data as $key => $value) {
            if($count == $total) {
                $output .= '"' . $key . '"' . '=>' . '"' . $value . '"';
            }
            else {
                $output .= '"' . $key . '"' . '=>' . '"' . $value . '"' . '<,>';
            }
            $count++;
        }
    }
    else {
        $count = 1;
        $total = count($data);

        foreach($data as $array_key => $array_data) {
            $array_data_count = 1;
            $array_data_total = count($array_data);

            $output .= '"' . $array_key . '"' . '=>[';

            foreach($array_data as $key => $value) {
                if($array_data_count == $array_data_total) {
                    $output .= '"' . $key . '"' . '=>' . '"' . $value . '"';
                }
                else {
                    $output .= '"' . $key . '"' . '=>' . '"' . $value . '"' . '<,>';
                }
                $array_data_count++;
            }

            if($count < $total) {
                $output .= ']<<,>>';
            }
            else {
                $output .= ']';
            }
            $count++;
        }
    }

    return $output;
}

/**
 * @param string $data
 * @param bool $multi
 * @return array
 */
function convertStringToArray(string $data, bool $multi = false) : array {
    $output = [];

    if(!$multi) {
        $array_data = explode('<,>', $data);
        foreach($array_data as $item) {
            $key = Str::before($item, '=>');
            $key = Str::replaceFirst('"', '', $key);
            $key = Str::replaceLast('"', '', $key);

            $value = Str::after($item, '=>');
            $value = Str::replaceFirst('"', '', $value);
            $value = Str::replaceLast('"', '', $value);

            $output[$key] = $value;
        }
    }
    else {
        $array_data = explode('<<,>>', $data);

        foreach($array_data as $item) {
            $key = Str::before($item, '=>[');
            $key = Str::replaceFirst('"', '', $key);
            $key = Str::replaceLast('"', '', $key);
            $value = Str::after($item, '=>[');
            $value = Str::replaceLast(']', '', $value);

            $inner_array_data = explode('<,>', $value);
            $inner_array = [];

            foreach($inner_array_data as $inner_item) {
                $inner_key = Str::before($inner_item, '=>');
                $inner_key = Str::replaceFirst('"', '', $inner_key);
                $inner_key = Str::replaceLast('"', '', $inner_key);

                $inner_value = Str::after($inner_item, '=>');
                $inner_value = Str::replaceFirst('"', '', $inner_value);
                $inner_value = Str::replaceLast('"', '', $inner_value);

                $inner_array[$inner_key] = $inner_value;
            }

            $output[$key] = $inner_array;
        }
    }

    return $output;
}


/**
 * @param array $new_log
 * @param string|null $logs
 * @param bool $multi_array
 * @return string
 */
function makeNewLog(array $new_log, string $logs = null, bool $multi_array = false) : string {
    if($logs == null) {
        $logs_array = [];
    }
    else {
        $logs_array = convertStringToArray($logs, $multi_array);
    }
    array_push($logs_array, $new_log);

    $output = convertArrayToString($logs_array, $multi_array);

    return $output;
}

/**
 * @param string $time
 * @param string $format
 * @return string
 */
function convertToBengaliDateTime(string $time, string $format = 'jS F Y, b hঃiঃs') : string {
    $bn_dt = BnDateTime::create($time)->getDateTime()->format($format);

    return $bn_dt;
}

function getSubStrLast(string $str, $length = null) : string {
    $str_len = strlen($str);
    $str_count = ($length) ? $length : $str_len;
    $n = 0;
    $output = '';
    for($i = $str_len - 1; $i >= 0; $i--) {
        $output = $str[$i] . $output;
        $n++;
        if($n >= $str_count) {
            break;
        }
    }
    return $output;
}

/**
 * @param string $name
 * @return DeliveryLocation|Model|null|object
 */
function getLocationByName(string $name) {
    return DeliveryLocation::where('location_name', '=', $name)->first();
}

/**
 * @param string|null $mobile
 * @return string|null
 */
function mobileNumber(string $mobile = null) {
    if(!$mobile) {
        return 'N/A';
    }
    $mobile = (strlen($mobile) > 10) ? substr($mobile, -10) : $mobile;

    return '+880 ' . substr($mobile, 0, 4) . ' ' . substr($mobile, -6);
}

/**
 * @param string|null $mobile
 * @return string
 */
function mobileNumberForStore(string $mobile = null) {
    if(!$mobile) { return null; }
    $mobile = str_replace(' ', '', $mobile);
    $mobile = preg_replace('/[^0-9.]+/', '', $mobile);

    return substr($mobile, -10);
}

/**
 * @param string $path
 * @return string
 */
function imageToDataUrl(string $path) {
    return (string) Image::make($path)->encode('data-url');
}

/**
 * Get Static File
 *
 * @param string $file
 * @return string
 */
function staticAsset(string $file) : string {
    if (App::environment('local')) {
        return asset("static/$file");
    }
    return config('app.static_file_url') . "/$file";
}

/**
 * Get Versioned Static File
 *
 * @param string $file
 * @return string
 */
function staticAssetV(string $file) : string {
    if (App::environment('local')) {
        return asset($file);
    }
    return config('app.static_file_url') . str_replace('/static', '', $file);
}
