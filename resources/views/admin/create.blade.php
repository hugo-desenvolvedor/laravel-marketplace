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
<h1>{{ __('Create Store') }}</h1>
<form action="{{ action('Admin\\StoreController@store') }}" method="POST">
    @csrf

    <div>
        <label for="name">
            {{__('Name')}}
        </label>
        <input type="text" id="name" name="name">
    </div>

    <div>
        <label for="description">
            {{__('Description')}}
        </label>
        <input type="text" id="description" name="description">
    </div>

    <div>
        <label for="phone">
            {{__('Phone')}}
        </label>
        <input type="text" id="phone" name="phone">
    </div>

    <div>
        <label for="mobile_phone">
            {{__('Mobile Phone')}}
        </label>
        <input type="text" id="mobile_phone" name="mobile_phone">
    </div>

    <div>
        <label for="slug">
            {{__('Slug')}}
        </label>
        <input type="text" id="slug" name="slug">
    </div>

    <div>
        <label for="user">
            {{__('User')}}
        </label>
        <select name="user" id="user">
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit" >{{ __('Save') }}</button>
    </div>
</form>
</body>
</html>
