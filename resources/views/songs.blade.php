@extends('app')

@section('content')
    <h2>Our songs</h2>
    <table class="songs">
        <thead>
            <tr class="head">
                <th>Sänger/in</th>
                <th>Song</th>
                <th>Tonart</th>
                <th>Noten</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>John</td>
                <td><strong>Conteo Regresivo</strong> (Santa Rosa)</td>
                <td>E-Dur</td>
                <td><a href="test">Noten</a></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Jane</td>
                <td><strong>Raining Blood</strong> (Slayer)</td>
                <td>E-Moll</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Jamie</td>
                <td><strong>Schön ist es auf der Welt zu sein</strong> (Roy Black & Anita)</td>
                <td>C-Dur</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
@endsection