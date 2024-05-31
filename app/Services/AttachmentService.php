<?php

namespace App\Services;

use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;
use Validator;

class AttachmentService {

    private function getPath($oktets): string {
        $path = '/public';
        $count = 0;
        foreach( $oktets as &$oktet) {
            if ($count < 4) {
                $path = $path.'/'.$oktet;
                $count += 1;
            }
        }
        return $path = $path.'/';
    }

    private function getAlias($oktets): string {
        $path = '/storage';
        $count = 0;
        foreach( $oktets as &$oktet) {
            if ($count < 4) {
                $path = $path.'/'.$oktet;
                $count += 1;
            }
        }
        return $path = $path.'/';
    }

    public function index() {
        return $attachments = Attachment::all();
    }

    public function store($input, $file): Attachment | string
    {
        $validator = Validator::make($input, [
            'postid' => 'required|integer'
        ]);
        if($validator->fails()){
            return 'Validation Error.'.$validator->errors();
        }
        $attachment = new Attachment();
        $hash = $file->hashName();
        $hashOktets = str_split(stristr($hash, '.', true), 2);
        $path = $this->getPath($hashOktets);
        $alias = $this->getAlias($hashOktets).$hash;

        $newAttchment = Attachment::create([
            'path' => $path.$file->hashName(),
            'type' => $file->extension(),
            'filename' => $file->hashName(),
            'alias' => $alias,
            'postid' => $input['postid']
        ]);

        Storage::disk('local')->put($path, $file);
        return $newAttchment;
    }

    public function show($id): Attachment | string  {
        $attachment = Attachment::find($id);
        if (is_null($attachment)) {
            return 'Attachment not found.';
        }
        return $attachment;
    }

    public function updateById($file, $id): Attachment | string  {
        if ($file && $file->isValid()) {
            $model = Attachment::find($id);

            Storage::disk('local')->delete($model->path);

            $hash = strtolower($file->hashName());
            $hashOktets = str_split(stristr($hash, '.', true), 2);
            $path = $this->getPath($hashOktets);
            $alias = $this->getAlias($hashOktets).$hash;

            $model->path = $path.$hash;
            $model->filename = $file->hashName();
            $model->type = $file->extension();
            $model->alias = $alias;
            $model->save();

            Storage::disk('local')->put($path, $file);
            return $model;
        } else {
            return "Invalid file uploaded.";
        }
    }

    public function destroy(Attachment $model): Attachment {
        $model->delete();
        return $model;
    }

    public function getByPostId($postId) {
        $attachments = Attachment::where('postid', $postId)->get();
        return $attachments;
    }
}
