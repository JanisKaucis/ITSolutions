<?php
namespace App\Services;

use App\Models\DelfiRss;
use Illuminate\Http\Request;

class MainPageService
{
    /**
     * @var Request
     */
    private $request;
    private $context;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handlePageShow() {
        $news = $this->getDataFromDB();
        $this->context['news'] = $news;
    }
    public function handleOptionsSelect()
    {
        if (empty($this->request->input('select'))){
            return;
        }
        $baseUrl = 'https://www.delfi.lv/rss/?channel=';
        if ($this->request->input('news')){
            $url = $baseUrl.$this->request->input('news');
            $xml = simplexml_load_file($url);
            DelfiRss::truncate();
            foreach ($xml->channel->item as $news) {
                $title = $news->title;
                $link = $news->link;
                $description = htmlspecialchars_decode($news->description);
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

    public function deleteRow() {
        if (empty($this->request->input('delete'))){
            return;
        }
        $news = $this->getDataFromDB();
        foreach ($news as $data)
        {
            if ($data->title == $this->request->input('value'))
            {
                DelfiRss::where(['title' => $this->request->input('value')])->delete();
            }
        }
    }
    public function getDataFromDB()
    {
        $this->news = DelfiRss::select(['title','link','description','image','date'])->get();
        return $this->news;
    }
    public function getContext()
    {
        return $this->context;
    }
}
