<?php

namespace Support\Faker;

use Faker\Provider\Base;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FakerImageProvider extends Base
{

    public function productImage( $source,  $target){

        $source = base_path($source); // источник
        // /tests/Fixtures/images/products/ // источник
        // $target = 'images/products'; // цель

        $files = File::allFiles($source);
        $randomFile = $files[array_rand($files)]; // рандомный файл
        $fileName = $randomFile->getFilename();   // имя
        $extension = $randomFile->getExtension(); // расширение

        $image = $source  . $fileName; // путь и выбранная картинка

        $newName = Str::random(6) . '.' . $extension;  // новая картинка
        if(!Storage::exists($target)) {
            Storage::makeDirectory($target); // создаем директорию
        }

        copy($image, storage_path('/app/public/'. $target). '/'. $newName); // копируем РАБОТАЕТ
        //     Storage::copy($image, $target. '/'. $newName); // копируем НЕ РАБОТАЕТ !!!


        return '/storage/'. $target.'/'.$newName ;

    }

    /*
     * Вариант от Danil Глава 3 ДЗ 05:16
     * $this->generatop->file(
                base_path('/tests/Fixtures/images/products'),
                storage_path('/app/public/images/products'),
                false
     *
     * */


}
