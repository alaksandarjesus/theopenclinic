<div
    class="modal fixed search-users top-0 left-0 bg-gray-300/40 w-full h-full flex justify-center items-center hidden z-[1020]">
    <div class="bg-white mx-3 w-full md:w-3/4 lg:w-1/2 h-auto rounded-lg shadow-lg p-5 relative">
        <div class="flex justify-between items-center">
            <div class="modal-title text-black font-medium text-lg">Search Users</div>
            <button class="btn-close btn-clickable disabled:opacity-75 disabled:cursor-not-allowed" data-value="0">
            @include('components.icons', ['icon'=>'close'])

            </button>
        </div>
        <div class="modal-body text-slate-900 text-base my-5">
            <form class="search-users">
                <div class="form-group  mb-3">
                    <div class="input-group">
                        <input value="alaks" type="text" name="query" class="form-control query w-full"
                            placeholder="Search...." aria-label="Search Users"
                            aria-describedby="search-users-submit-button">
                    </div>
                    <small class="text-sm text-color-400">Press "Enter" to Search</small>
                </div>
                <div class="users-list-table max-h-96 overflow-auto"></div>
                <div class="no-users-found text-lg font-semibold text-red-600">
                    No users found
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/html" id="searchUsersModalUsersListTemplate">
<table class="table-auto w-full">
    <thead>
        <tr>
            <th class="border border-gray-1 p-2">Name</th>
            <th class="border border-gray-1 p-2">Email</th>
            <th class="border border-gray-1 p-2">Mobile</th>
        </tr>
    </thead>
    <tbody>
        <% _.forEach(users, function(user){ %>
        <tr class="cursor-pointer user-row hover:bg-gray-100" data-uuid="<%- user.uuid %>" data-username="<%- user.username %>">
            <td class="border border-gray-1 p-2 name "><%- user.name %></td>
            <td class="border border-gray-1 p-2 email"><%- user.email %></td>
            <td class="border border-gray-1 p-2 mobile"><%- user.mobile %></td>
            <td class="hidden blood-group"><%- user.blood_group %></td>
            <td class="hidden gender"><%- user.gender %></td>
            <td class="hidden dob"><%- _.get(user, 'formatted.dob', '') %></td>
            <td class="hidden age"><%- _.get(user, 'formatted.age', '') %></td>
            <td class="hidden age"><%- user.age %></td>
        </tr>
        <% }) %>
    </tbody>
</table>
</script>