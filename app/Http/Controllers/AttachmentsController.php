<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Attachment;

class AttachmentsController extends Controller
{
    public function index() {
        return;
    }
    public function store(Request $request) {
        $file = $request->file('file');
        $data = $this->getData($file);
        $this->saveToDB($data);

        return back();
    }
    public function update() {

    }
    public function destroy($attachment_id) {
        $attachment = Attachment::find($attachment_id);
        $attachment->delete();
        return back();
    }

    // Custom helper functions
    public function getData($file) {
        $filename_full = str_replace(' ' ,'' ,$file->getClientOriginalName());
        $extension = $file->getClientOriginalExtension();
        $nameWithoutExtentsion = str_replace('.' . $extension, '', $filename_full);
        $mime = $file->getMimeType();
        if (strpos($mime,'image') !== false) {
            $extension = "jpg";
        }
        $filename = $nameWithoutExtentsion.'_'.Carbon::now()->timestamp.'_'.generateRandomString(5).'.'.$extension;
        $i = '1';
        while (file_exists('uploads/' . $filename)) {
            $filename = $nameWithoutExtentsion . '_' . $i . '.' . $extension;
            $i++;
        }
        return $data = array('filename' => $filename,'mime' => $mime);
    }

    public function saveToDB($data) {
        $file_in_db = new Attachment();
        $file_in_db->name = $data['filename'];
        $file_in_db->mime = $data['mime'];
        $file_in_db->save();
        return $file_in_db;
    }
}
