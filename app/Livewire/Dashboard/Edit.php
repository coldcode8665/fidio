<?php

namespace App\Livewire\Dashboard;

use getID3;

use Google_Client;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Http\Request;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Google_Http_MediaFileUpload;
use App\Models\Video as FidioVidio;
use App\Models\Distribution;
use App\Models\Video;
use Google\Service\YouTube as GSYT;
use Illuminate\Support\Facades\Http;
use Google\Service\YouTube\VideoStatus;
use Illuminate\Support\Facades\Storage;


// use Madcoda\Youtube\Youtube;
// use Google_Http_MediaFileUpload;

use Google\Service\YouTube\VideoSnippet;
// use Google_Service_YouTube_VideoStatus;
// use Google_Service_YouTube_VideoSnippet;
// use Google_Http_Request;


use Google\Service\YouTube\Video as GSYTV;
use Symfony\Component\HttpFoundation\File\File;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    #[Rule('required')]
    public $title = "";

    #[Rule('required')]
    public $description = "";

    #[Rule('numeric')]
    public $price = "";

    // #[Rule('image|max:10024')] // 1MB Max
    public $thumbnail;

    public $toggle;


    public $video;

    public $youtubeData;
    public $cid = [];
    public $visibility = "";

    public function mount(Video $video)
    {
        $this->video = $video;

        $this->title = $this->video->title;
        $this->description = $this->video->description;
        $this->visibility = $this->video->visibility;

        $this->price = $this->video->price ? $this->video->price : null;

        $this->toggle = Distribution::where('user_id',auth()->id())->first();
        if(session()->has('video')){
            $this->title = session('video')['title'];
            $this->description = session('video')['description'];
        }

        if (session()->has("token")) {
            $response = Http::withToken(session('token'))->get('https://www.googleapis.com/youtube/v3/channels?part=snippet,contentDetails,statistics&mine=true&key=' . env('YOUTUBE_API_KEY'));
            $data = $response->json();
            $this->youtubeData = $data['items'];
        }
    }

    public function setProp(){
        
        session(
            [
                'video' => [
                    'title' => $this->title,
                    'description' => $this->description,
                ]

            ]
        );

        return redirect()->route('auth.google');

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
        // $this->validate();
     
        $thumbnail_path = $this->thumbnail ? $this->thumbnail->store('thumbnail') : null;

        $data = FidioVidio::where('id',$this->video->id)->update([
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => $thumbnail_path ? $thumbnail_path : $this->video->thumbnail,
            'visibility' => $this->visibility ? $this->visibility : $this->video->visibility,
            'price' => $this->price ? $this->price : null
        ]);

        if (count($this->cid) > 0) {

            FidioVidio::where('id',$data->id)->update(['youtube' => true]);

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

            if(session()->has('video')){
                session(['video' => null]);
            }
            return redirect()->route('dashboard.videos');

        } else {
            if(session()->has('video')){
                session(['video' => null]);
            }
            return redirect()->route('dashboard.videos');
        }
    }


    #[Layout('components.dashboard.layout')]
    public function render()
    {
        return view('livewire.dashboard.edit');
    }
}
