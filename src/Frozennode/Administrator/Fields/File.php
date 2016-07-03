<?php

namespace Frozennode\Administrator\Fields;

use Frozennode\Administrator\Includes\Multup;

class File extends Field
{
    /**
     * The specific defaults for subclasses to override.
     *
     * @var array
     */
    protected $defaults = array(
        'naming'            => 'random',
        'length'            => 32,
        'mimes'             => false,
        'size_limit'        => 2,
        'display_raw_value' => false,
        'path'              => '/',
    );

    /**
     * The specific rules for subclasses to override.
     *
     * @var array
     */
    protected $rules = array(
        'path'   => 'string',
        'length' => 'integer|min:0',
        'mimes'  => 'string',
    );

    /**
     * Builds a few basic options.
     */
    public function build()
    {
        parent::build();

        //set the upload url depending on the type of config this is
        $url   = $this->validator->getUrlInstance();
        $route = $this->config->getType() === 'settings' ? 'admin_settings_file_upload' : 'admin_file_upload';

        //set the upload url to the proper route
        $this->suppliedOptions['upload_url'] = $url->route($route, array($this->config->getOption('name'), $this->suppliedOptions['field_name']));
    }

    /**
     * This static function is used to perform the actual upload and resizing using the Multup class.
     *
     * @return array
     */
    public function doUpload()
    {
        $disk = \Storage::disk($this->getOption('disk'));
        $file = \Input::file('file');

        $ext = $file->getClientOriginalExtension() ?: $file->guessClientExtension();

        $filename = md5_file($file->getRealPath()).'.'.$ext;
        $put_path = trim($this->getOption('path'), ' /').'/'.$filename;

        if (!$disk->exists($put_path)) {
            $f_res = fopen($file->getRealPath(), 'r');
            $disk->put($put_path, $f_res);
            fclose($f_res);
        }

        return [
            'errors'        => [],
            'path'          => trim($put_path, '/'),
            'filename'      => trim($put_path, '/'),
            'original_name' => $file->getClientOriginalName(),
        ];
    }
}
