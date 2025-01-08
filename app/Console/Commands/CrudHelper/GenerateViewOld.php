<?php

namespace App\Console\Commands\CrudHelper;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateViewold
{
    private $stubPath = "";

    public function __construct($stubPath)
    {
        $this->stubPath = $stubPath;
    }

    public function generateViews($modelVariables)
    {
        // Direktori stub views
        $stubViewsPath = $this->stubPath . '/views';

        // Direktori output views
        $viewDir = resource_path("views/" . $modelVariables['modelRoute']);

        // Cari semua file .stub secara rekursif
        $allStubFiles = File::allFiles($stubViewsPath);

        $stubFiles = [];
        $subStubFiles = [];

        // Filter stub files, hindari create.stub dan edit.stub
        foreach ($allStubFiles as $file) {
            $fileName = $file->getFilename();

            if (in_array($fileName, ['create.stub', 'edit.stub', 'form.stub', 'form.field.stub', 'form.field.dropdown.stub', 'form.field.number.stub', 'show.stub', 'show.field.stub'])) {
                continue;
            }

            if (explode('.', $fileName) > 2) { // atau part of main stub file
                $subStubFiles[] = $file;
            } else {
                $stubFiles[] = $file;
            }
        }

        // Buat direktori views
        File::makeDirectory($viewDir, 0755, true, true);

        foreach ($stubFiles as $stubFile) {
            $relativePath = Str::after($stubFile->getPathname(), $stubViewsPath . DIRECTORY_SEPARATOR);
            $viewRelativePath = Str::replaceLast('.stub', '.blade.php', $relativePath);
            $viewFullPath = $viewDir . '/' . $viewRelativePath;

            File::makeDirectory(dirname($viewFullPath), 0755, true, true);

            $viewContent = File::get($stubFile->getPathname());
            $stubFilePart = explode('.', $stubFile->getFilename(), 2)[0];

            if (empty($subStubFiles)) {
                throw new \Exception("Wajib ada file field, minimal 1.", 1);
            }

            // scan dulu file stub main, lalu cari berdasarkan pola {{{xxx.xxx}}} -> jadi syaratnya adalah kurung kurawal ada 3
            // dan jika didalamnya ada wildcard type -> maka replace dengan column type value
            // kalau sudah ditemukan baru replace pola nya dengan file yang dimaksudkan
            // kalau ada type maka cari file berdasarkan type nya
            // jadi step pertama adalah untuk mempermudah bikin array dengan struktur 
            // [
            //     {
            //         "main": "create.stub",
            //         "child": []
            //     },
            //     {
            //         "main": "edit.stub",
            //         "child": []
            //     },
            //     {
            //         "main": "form.stub",
            //         "child": ["form.field.text.stub", "form.field.number.stub", "form.field.dropdown.stub"]
            //     },
            //     {
            //         "main": "index.stub",
            //         "child": ["index.header.stub", "index.body.stub"]
            //     },
            //     {
            //         "main": "show.stub",
            //         "child": ["show.field.stub"]
            //     }
            // ]


            // Gabungkan konten sub stub
            $viewSubContentCombine = $this->generateSubStubContent($modelVariables, $subStubFiles, $stubFilePart);

            // Ganti placeholder sub stub
            $viewContent = str_replace("{{" . $stubFilePart . ".field.stub}}", $viewSubContentCombine, $viewContent);

            // Ganti placeholder variabel model
            foreach ($modelVariables as $key => $value) {
                if (is_string($value)) {
                    $viewContent = str_replace("{{" . $key . "}}", $value, $viewContent);
                }
            }

            // Simpan file view
            File::put($viewFullPath, $viewContent);
        }
    }

    protected function generateSubStubContent($modelVariables, $subStubFiles, $stubFilePart)
    {
        $viewSubContentCombine = "";

        foreach ($modelVariables['fieldRules'] as $column => $rules) {
            $matchingSubStub = $this->findMatchingSubStub($subStubFiles, $stubFilePart, $rules['type']);

            if ($matchingSubStub) {
                $viewSubContent = File::get($matchingSubStub->getPathname());
                $viewSubContent = strtr($viewSubContent, [
                    '{{column}}' => $column,
                    '{{column_value}}' => isset($rules['values']) ? var_export($rules['values'], 1) : "",
                    '{{column_title}}' => Str::title(Str::replace('_', ' ', $column))
                ]);

                $viewSubContentCombine .= "\n" . $viewSubContent;
            }
        }

        return $viewSubContentCombine;
    }

    protected function findMatchingSubStub($subStubFiles, $stubFilePart, $fieldType)
    {
        // cari file substub berdasarkan field type nya
        if ($fieldType == "text") {
            $searchSubStubFileName = "$stubFilePart.field.stub";
        } else {
            $searchSubStubFileName = "$stubFilePart.field.$fieldType.stub";
        }

        foreach ($subStubFiles as $subStubFile) {
            $subStubFilename = $subStubFile->getFilename();

            if ($searchSubStubFileName == $subStubFilename) {
                return $subStubFile;
            }
        }

        return null;
    }
}
