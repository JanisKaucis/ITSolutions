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

    public function handlePageShow(): void
    {
        $news = $this->getDataFromDB();
        if (!empty($this->request->session()->get('sort'))){
            $news = $this->sortTable();
            $this->request->session()->forget('sort');
        }
        $this->context['news'] = $news;
    }

    public function handleOptionsSelect(): void
    {
        if (empty($this->request->input('select'))) {
            return;
        }
        $baseUrl = 'https://www.delfi.lv/rss/?channel=';
        if ($this->request->input('news')) {
            $url = $baseUrl . $this->request->input('news');
            $xml = simplexml_load_file($url);
            DelfiRss::truncate();
            $i = 1;
            foreach ($xml->channel->item as $news) {
                $title = $news->title;
                $link = $news->link;
                $description = htmlspecialchars_decode($news->description);
                $image = $news->children('media', true)->content->attributes();
                $date = $news->pubDate;
                DelfiRss::updateOrCreate([
                    'news_id' => $i,
                    'title' => $title,
                    'link' => $link,
                    'description' => $description,
                    'image' => $image,
                    'date' => $date
                ]);
                $i++;
            }
        }

    }

    public function deleteRow(): void
    {
        if (empty($this->request->input('delete'))) {
            return;
        }
        $news = $this->getDataFromDB();
        foreach ($news as $data) {
            if ($data->news_id == $this->request->input('news_id')) {
                DelfiRss::where(['title' => $this->request->input('value')])->delete();
            }
        }
    }

    public function editTitle(): void
    {
        if (empty($this->request->input('edit'))) {
            return;
        }
        $news = $this->getDataFromDB();
        foreach ($news as $data) {
            if ($data->news_id == $this->request->input('id')) {
                DelfiRss::where(['title' => $this->request->input('title')])
                    ->update(['title' => $this->request->input('text')]);
            }
        }
    }

    public function sortTable()
    {
        $news = DelfiRss::select(['news_id', 'title', 'link', 'description', 'image', 'date'])
            ->orderBy('title')
            ->get();
        $this->request->session()->put('sort', $this->request->input('sort'));
        return $news;
    }

    public function getDataFromDB(): object
    {
        $news = DelfiRss::select(['news_id', 'title', 'link', 'description', 'image', 'date'])->get();
        return $news;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
