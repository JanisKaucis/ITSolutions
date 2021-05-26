<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<form method="post">
    @csrf
    <label for="cars">Choose news type:</label>

    <select class="button aqua" id="news" name="news">
        <option value="aculiecinieks">Aculiecinieks</option>
        <option value="auto">Auto</option>
        <option value="bizness">Bizness</option>
        <option value="calis">Cālis.LV</option>
        <option value="delfi">Jaunākās</option>
        <option value="sabiedriba">Sabiedrība</option>
        <option value="izklaide">Izklaide</option>
        <option value="kultura">Kultūra</option>
        <option value="laikazinas">Laika ziņas</option>
        <option value="majadarzs">Māja/dārzs</option>
        <option value="mansdraugs">Mans draugs</option>
        <option value="orakuls">Orakuls</option>
        <option value="receptes">Receptes</option>
        <option value="skats">Skats.LV</option>
        <option value="sports">Sports</option>
        <option value="tasty">Tasty</option>
        <option value="tavamaja">Tava māja</option>
        <option value="turismagids">Tūrisma gids</option>
        <option value="tv">TV ziņas</option>
        <option value="vina">viņa lv</option>
    </select>
    <input class="button" type="submit" name="select" value="Choose">
</form>
<input class="button aqua" type="text" id="myInput" onkeyup="searchTable()" placeholder="Search for title">

<form method="post">
    @csrf
    <label for="sort">Click the button to sort by title:</label>
    <input type="submit" class="button" name="sort" value="Sort">
</form>
<div class="table-wrapper">
    <table id="table" class="fl-table">
        <tr>
            <th>Title</th>
            <th>Link</th>
            <th>description</th>
            <th>Image</th>
            <th>Date</th>
            <th>Edit Title</th>
            <th>Delete</th>
        </tr>
        @if(!empty($news))
            @foreach($news as $data)
                <tr>
                    <td>
                        <div id="{{ $data->news_id }}">{{ $data->title }}</div>
                        <div id="hide-{{ $data->news_id }}" style="display: none">
                            <form method="post">
                                @csrf
                                <input name="id" value="{{ $data->news_id }}" type="hidden">
                                <input name="title" value="{{ $data->title }}" type="hidden">
                                <textarea id="title-hide" name="text" rows="4" cols="20">{{ $data->title }}</textarea>
                                <input class="button" type="submit" name="edit" value="Edit">
                            </form>
                        </div>

                    </td>
                    <td><a href="{{ $data->link }}">{{ $data->link }}</a></td>
                    <td>{{ $data->description }}</td>
                    <td><img height="100px" src="{{ $data->image }}" alt="News Image"></td>
                    <td>{{ $data->date }}</td>
                    <td>
                        <button class="button" onclick="showEdit({{ $data->news_id }})">Edit</button>
                    </td>
                    <td>
                        <form method="post">
                            @csrf
                            <input name="news_id" value="{{ $data->news_id }}" type="hidden">
                            <input name="value" value="{{ $data->title }}" type="hidden">
                            <input class="button" type="submit" name="delete" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
</div>
</body>
<script type="text/javascript" src="{{ asset('js/showEdit.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/searchTable.js') }}"></script>
</html>
