<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        @if (count(Auth::user()->unreadNotifications))
            <h4>Notifications</h4>
            
            <form action="/users/{{ Auth::id() }}/notifications" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <ul>
                    @foreach(Auth::user()->unreadNotifications as $notification)
                        <li>Task created at {{ $notification->data['task_created_at']['date'] }}</li>
                    @endforeach
                </ul>
                <button type="submit">Mark all as read</button>
            </form>
        @endif

        <h4>Tasks</h4>
        <ul>
            @foreach($tasks as $task)
                <li>
                    {{ $task->body }}
                </li>
            @endforeach
        </ul>


        <form method="post" action="/tasks">

            {{ csrf_field() }}

            <div class="form-group">
                <textarea id="body" name="body" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </body>
</html>
