<?php
namespace App\Services;

use App\Models\DelfiRss;
use DOMDocument;
use Illuminate\Http\Request;
use SimpleXMLElement;

class MainPageService
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handlePageShow() {

    }
    public function handleOptionsSelect() {
        if (empty($this->request->input('select'))){
            return;
        }
        $baseUrl = 'https://www.delfi.lv/rss/?channel=';
        if ($this->request->input('news')){
            $url = $baseUrl.$this->request->input('news');
            $xml = simplexml_load_file($url);

            foreach ($xml->channel->item as $news) {
                $title = $news->title;
                $link = $news->link;
                $description = $news->description;
                $image = $news->children('media',true)->content->attributes();
                $date = $news->pubDate;
                DelfiRss::updateOrCreate([
                    'title' => $title,
                    'link' => $link,
                    'description' => $description,
                    'image' => $image,
                    'date' => $date
                ]);
            }
        }
    }
}
