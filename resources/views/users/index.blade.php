<!doctype html>
<html>
<head>
    <title>Users Index</title>
    @vite('resources/css/app.css')
</head>
<body class="p-10 bg-gray-50">
  <div class="flex mb-5">
    <h1 class="text-xl font-bold flex-grow">Users Index</h1>
    @can('create user')
    <a href="{{ route('users.create') }}" class="shadow border bg-teal-500 hover:bg-teal-600 text-white rounded-md px-2 py-1">Create user</a>
    @endcan
  </div>

  <table class="w-full">
    <thead class="bg-gray-100">
      <tr>
        <th class="p-1">ID</th>
        <th class="p-1">Name</th>
        <th class="p-1">Email</th>
        @canany(['update user', 'delete user'])
        <th class="p-1">Actions</th>
        @endcanany
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
      <tr>
        <td class="p-1 border-b text-center">{{ $user->id }}</td>
        <td class="p-1 border-b text-center">{{ $user->name }}</td>
        <td class="p-1 border-b text-center">{{ $user->email }}</td>
        @canany(['update user', 'delete user'])
        <td class="p-1 border-b text-center whitespace-nowrap">
          @can('update user')
          <a href="{{ route('users.edit', $user) }}" class="text-teal-500">Edit</a>
          @endcan

          @can('delete user')
          <form method="post" action="{{ route('users.destroy', $user) }}" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Delete this user?')">Delete</button>
          </form>
          @endcan
        </td>
        @endcanany
      </tr>
    @endforeach
    </tbody>
  </table>
</body>
</html>
