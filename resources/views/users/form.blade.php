<!doctype html>
<html>
<head>
    <title>{{ isset($user) ? 'Edit' : 'Create' }} User</title>
    @vite('resources/css/app.css')
</head>
<body class="p-10 bg-gray-50">
  <div class="flex mb-5">
    <h1 class="text-xl font-bold flex-grow">{{ isset($user) ? 'Edit' : 'Create' }} User</h1>
  </div>

  <form method="post" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" class="space-y-5">
    @csrf
    @if (isset($user))
      @method('PATCH')
    @endif
    <fieldset>
      <label for="name" class="block">Name:</label>
      <input type="text" name="name" id="name" class="focus:ring-teal-500 rounded-md shadow mt-2" value="{{ $user->name ?? '' }}" required>
    </fieldset>

    <fieldset>
      <label for="email" class="block">Email:</label>
      <input type="email" name="email" id="email" class="focus:ring-teal-500 rounded-md shadow mt-2" value="{{ $user->email ?? '' }}" required>
    </fieldset>

    <fieldset>
      <label for="password" class="block">Password:</label>
      <input type="password" name="password" id="password" class="focus:ring-teal-500 rounded-md shadow mt-2"{{ isset($user) ? '' : ' required' }}>
    </fieldset>

    <button type="submit" class="rounded-md bg-teal-500 hover:bg-teal-600 text-white px-2 py-1">Submit</button>
    <button type="button" class="rounded-md bg-gray-400 hover:bg-gray-500 text-white px-2 py-1" onclick="window.location.href = '{{ route('users.index') }}'">Cancel</button>
  </form>
</body>
</html>
