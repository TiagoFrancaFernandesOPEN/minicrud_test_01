@extends('layout/site')
@php ($pageName = 'User list' )
@section('title',$pageName.' | ' . env('APP_NAME'))

@section('content')
<div class="container">
    <h4>{{ $pageName }}</h4>

    <div class="row">
        <a class="btn blue right action add">Add user</a>
    </div>
    <div class="row">
        <table id="userList">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Profile type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($users as $user)
            
            @switch ($user->user_profile)            
                @case(1)
                @php ($profile_type = 'ADMIN')
                    @break

                @case(2)
                @php ($profile_type = 'MANAGER')
                    @break

                @default
                @case(2)
                @php ($profile_type = 'USER')
            @endswitch

            @php ($trId= 'trId_'.$user->user_id)                  
                <tr id="{{ $trId }}">
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->user_fullname }}</td>
                    <td>{{ $user->user_email }}</td>
                    <td>{{ $profile_type }}</td>
                    <td>
                    <a class="btn deep-blue action edit" userid="{{ $user->user_id }}">Edit</a>
                    <a class="btn red action delete" userid="{{ $user->user_id }}">Delete</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <div class="row center">
        {{ $users->links('layout/pagination') }}
    </div>
</div>
<style>
    #formUserModal{width: 100%; top: 10% !important; min-height: 85%;}
    #formUserModal div.modal-overlay{background: #0000 !important;}
</style>
  <!-- Modal Structure -->
  <div id="formUserModal" class="modal">
    <div class="modal-content">
      <h4 id="formUserTitle"></h4>
        <form >
        <div class="input-field" style="display:none">
            <input type="text" id="form_user_id" placeholder="user_id">
        </div>
        
        <div class="input-field">
            <input type="text" id="form_user_fullname" placeholder="User fullname" required>
        </div>

        <div class="input-field">
            <input type="text" id="form_user_email" placeholder="User email" required>
        </div>

        <div class="input-field">
            <input type="text" id="form_user_birth_date" placeholder="User birth date" required>
        </div>
        <div class="input-field">
            <input type="text" id="form_user_password" placeholder="User password" required>
        </div>

        <div class="input-field">
            <p>
            <strong>Profile Type</strong><br>
                <label>
                    <input type="radio" name="form_user_profile" id="form_user_profile_1" value="1" required />
                    <span>ADMIN</span>
                </label><br>
                <label>
                    <input type="radio" name="form_user_profile" id="form_user_profile_2" value="2" required />
                    <span>MANAGER</span>
                </label><br>
                <label>
                    <input type="radio" name="form_user_profile" id="form_user_profile_3" value="3" required />
                    <span>USER</span>
                </label>
            </p>
            <br>
        </div>
        <button class="btn waves-effect waves-light" type="submit" actiontype="" id="submit_form">Submit
            <i class="material-icons right">send</i>
        </button>
    </form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>
@endsection
@push('scripts')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/crud.js') }}"></script>
@endpush
