<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    @csrf
    <label for="cars">Choose news type:</label>

    <select id="news" name="news">
        <option value="aculiecinieks">Aculiecinieks</option>
        <option value="auto">Auto</option>
    </select>
    <input type="submit" name="select" value="Choose">
</form>
<input type="text" id="myInput" onkeyup="titleSearch()" placeholder="Search for title">
<table id="myTable" style="width: 100%">
    <tr>
        <th>Title</th>
        <th>Link</th>
        <th>description</th>
        <th>Image</th>
        <th>Date</th>
        <th>Delete</th>
    </tr>
    @if(!empty($news))
        @foreach($news as $data)
            <tr>
                <td>  {{ $data->title }}</td>
                <td><a href="{{ $data->link }}">{{ $data->link }}</a></td>
                <td>{{ $data->description }}</td>
                <td><img height="100px" src="{{ $data->image }}" alt="News Image"></td>
                <td>{{ $data->date }}</td>
                <td>
                    <form method="post">
                        @csrf
                        <input name="value" value="{{ $data->title }}" type="hidden">
                        <input type="submit" name="delete" value="Delete">
                    </form>
                </td>
            </tr>
        @endforeach
    @endif
</table>
</body>
<script>
    function titleSearch() {
        var input, filter, table, tr, title, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            title = tr[i].getElementsByTagName("td")[0];
            if (title) {
                txtValue = title.textContent || title.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
</html>
