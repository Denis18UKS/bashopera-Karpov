@extends('lauouts.header')
@section('title', 'Главная')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Башкирский государственный театр оперы и балета</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <div class="hero">
            <img src="{{asset('images/theater-image.jpg')}}" alt="Башкирский театр">
            <h1>Башкирский государственный театр оперы и балета</h1>
        </div>

        <div class="header-info">
            <div>
                <p>Дата основания: 1938 г.</p>
                <p>Репертуар: 72 произведения</p>
                <p>Возрастное ограничение: 0+</p>
            </div>
            <a href="#" class="button">Узнать подробнее</a>
        </div>
    </header>

    <section class="container">
        <h2>Ближайшие премьеры</h2>
        <div class="events">
            @foreach ($events as $event)
            <div class="event">
                <img src="{{asset('storage/' . $event->image)}}" alt="{{$event->title}}">
                <h3>{{$event->title}}</h3>
                <p>{{$event->subtitle}}</p>
                <p class="date">{{$event->show_date->format('d F, H:i')}}</p>
                <p>{{ $event->ageRestriction->tvalue ?? 'Без ограничений'}}</p>
                <a href="#" class="button">Подробнее</a>
            </div>
            @endforeach
        </div>

        <div class="buttons">
            <a href="#" class="button">Правила поведения</a>
            <a href="#" class="button">Схема зала</a>
            <a href="#" class="button">История театра</a>
            <a href="#" class="button">Коллектив театра</a>
        </div>

        <h2>Новости театра</h2>
        <div class="news">
            @foreach ($latestNews as $news)
            <div class="news-item">
                <img src="{{asset('storage/' . $news->image)}}" alt="{{$news->title}}">
                <h3>{{$news->title}}</h3>
                <p>{{$news->description}}</p>
                <p class="date">{{$news->created_at->format('d.m.Y')}}</p>
            </div>
            @endforeach
        </div>

        <a href="#" class="button">Показать все новости</a>
    </section>
</body>

</html>
@endsection