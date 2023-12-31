<?php

namespace App\Livewire\Dashboard;

use getID3;

use App\Models\Video as FidioVidio;
use Livewire\Component;
use Google\Service\YouTube as GSYT;
use Google\Service\YouTube\Video as GSYTV;
use Google\Service\YouTube\VideoSnippet;
use Google\Service\YouTube\VideoStatus;
use Google_Client;
use Google_Http_MediaFileUpload;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;


// use Madcoda\Youtube\Youtube;
// use Google_Http_MediaFileUpload;

use Illuminate\Support\Facades\Http;
// use Google_Service_YouTube_VideoStatus;
// use Google_Service_YouTube_VideoSnippet;
// use Google_Http_Request;


use Symfony\Component\HttpFoundation\File\File;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class NewVideo extends Component
{
    use WithFileUploads;

    #[Rule('required')]
    public $title = "";

    #[Rule('required')]
    public $description = "";

    #[Rule('required|image|max:1024')] // 1MB Max
    public $thumbnail;

    #[Rule('required|file|mimes:mp4,avi,mpeg')]
    public $video;

    public $youtubeData;
    public $cid = [];
    public $visibility = "public";

    public function mount()
    {
        if (session()->has("token")) {
            /*$response = Http::withToken(session('token'))->get('https://www.googleapis.com/youtube/v3/channels', [
                'part' => 'snippet,contentDetails,brandingSettings',
                'mine' => true
                // 'key' => env('YOUTUBE') 
            ]); */
            $response = Http::withToken(session('token'))->get('https://www.googleapis.com/youtube/v3/channels?part=snippet,contentDetails,statistics&mine=true&key=' . env('YOUTUBE_API_KEY'));
            $data = $response->json();
            //dd($data);
            $this->youtubeData = $data['items'];
        }
    }

    #[On('channel_id')]
    public function channel_data($id, $distribution)
    {
        return array_push($this->cid, ["id" => $id, "distribution" => $distribution]);
    }

    public function clearVideo()
    {
        $this->video = null;
    }

    #[On('visib')]
    public function visible($status)
    {
        return $this->visibility = $status;
    }

    public function save()
    {

        $this->validate();
        if (count($this->cid) < 1) {
            return session()->flash('distroerror', "Please select a distribution.");
        }
        $path = $this->video->store("videos");
        $thumbnail_path = $this->thumbnail->store('thumbnail');
        //dd(storage_path($path));
        //chown(storage_path($path), 'daemon');

        $data = FidioVidio::create([
            'user_id' => auth()->id(),
            'video' => $path,
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => $thumbnail_path,
            'visibility' => $this->visibility
        ]);
        if ($data) {
            $gclient = new Google_Client();
            $gclient->setApplicationName("FIDIO");
            $gclient->setScopes([
                'https://www.googleapis.com/auth/youtube.upload',
            ]);
            $gclient->setHostedDomain('global');
            $gclient->setAccessType('offline');
            $gclient->setAccessToken(session('token'));
            $service = new GSYT($gclient);
            $video = new GSYTV();
           
            $vSnippet = new VideoSnippet();

            $vSnippet->title = $data->title;
            $vSnippet->tags = array('fidio');
            $vSnippet->description = $data->description;
            /* $vSnippet->categoryId = ; */

            $video->setSnippet($vSnippet);

            $vStatus = new VideoStatus();
            $vStatus->privacyStatus = 'private';
            $video->setStatus($vStatus); // Set the privacy status of the video

            $gclient->setDefer(true);
            $resource = [
                'snippet' => $video->getSnippet()
                // Add other required parameters for the video upload
                // ...
            ];

            // Create a request object
            $request = $service->videos->insert('status,snippet', $video, ['mediaUpload' => true]);

            $chunkSizeBytes = 1 * 1024 * 1024; // Set the chunk size for resumable uploads

            $media = new Google_Http_MediaFileUpload(
                $gclient,
                $request,
                'video/*',
                null,
                true,
                $chunkSizeBytes
            );
            $media->setFileSize(filesize(storage_path('app/public/'.$data->video))); // Set the file size of the video

            $status = false;
            $handle = fopen(storage_path('app/public/'.$data->video), 'rb');
            while (!$status && !feof($handle)) {
                $chunk = fread($handle, $chunkSizeBytes);
                $status = $media->nextChunk($chunk);
            }
            fclose($handle);

            return redirect()->route('dashboard.videos');
        } else {

            dd("oops something went wrong");
        }
    }


    #[Layout('components.dashboard.layout')]
    public function render()
    {
        return view('livewire.dashboard.new-video');
    }
}
