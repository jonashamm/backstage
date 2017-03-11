<?php

namespace App\Http\Controllers;

use App\Attachmenttype;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Attachment;
use File;


class AttachmentsController extends GlobalController
{
    public function index() {
        return;
    }

    public function destroy($attachment_id) {
        $attachment = Attachment::find($attachment_id);
	    File::delete(url('/uploads/'.$attachment->name));
        $attachment->delete();
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


	public function store(Request $request, $path = "uploads") {
		$file = $request->file('file');
		$stored_file = $request->file('file')->storeAs($path,str_random(36));

		$file_in_db = new Attachment();
		$file_in_db->type = $request->input('type');
		$file_in_db->name = $file->getClientOriginalName();
		$file_in_db->physical_name = str_replace($path.'/','',$stored_file);
		$file_in_db->mime = $file->getMimeType();
		$file_in_db->song_id = $request->input('song_id');
		$file_in_db->comment = $request->input('comment');
		$file_in_db->save();
		return $file_in_db;
	}

	public function indexByTypeAPI($song_id) {
    	return Attachmenttype::with(array('attachments' => function($query) use ($song_id) {
		    $query->where('song_id',$song_id)->orderBy('created_at','desc')->get();
	    }))->get();
	}

	public function download($attachemnt_id) {
    	$attachemnt = Attachment::find($attachemnt_id);
		return response()->download(storage_path().'/uploads/'. $attachemnt->physical_name, $attachemnt->name);
	}
}
