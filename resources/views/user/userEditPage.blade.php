@extends('admin.layouts.master')
@section('title', 'User Account Edit Page')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Account Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Account Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 offset-2">
                <form action="{{ route('user#edit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ Auth::user()->name }}Account</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id" class="form-control" value="{{ Auth::user()->id }}">
                            <div class="text-center">
                                {{-- <img class="profile-user-img img-fluid img-circle" src=""
                                    alt="User profile picture"> --}}
                                @if (Auth::user()->image == null)
                                @if (Auth::user()->gender == 'male')
                                <img src="{{ asset('avatarimg/avatar_male.png') }}"
                                    class="profile-user-img img-fluid img-circle" alt="User profile picture" alt="">
                                @else
                                <img src="{{ asset('avatarimg/avatar_female.png') }}"
                                    class="profile-user-img img-fluid img-circle" alt="User profile picture" alt="">
                                @endif
                                @else
                                <img src="{{ asset('ProjectImg/' . Auth::user()->image) }}"
                                    class="profile-user-img img-fluid img-circle" alt="User profile picture"
                                    style="width:100px; height:100px" alt="">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="image">Change image here</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid  @enderror" value="">
                                @error('image')
                                <div>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Change Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid  @enderror"
                                    value="{{ old('name', Auth::user()->name) }}">
                                @error('name')
                                <div>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Change Email</label>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid  @enderror"
                                    value="{{ old('name', Auth::user()->email) }}">
                                @error('email')
                                <div>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Change Phone</label>
                                <input type="text" name="phone" id="phone"
                                    class="form-control @error('phone') is-invalid  @enderror"
                                    value="{{ old('name', Auth::user()->phone) }}">
                                @error('phone')
                                <div>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Change Address</label>
                                <textarea name="address" id="address"
                                    class="form-control @error('address') is-invalid  @enderror" value=''
                                    rows="4">{{ old('address', Auth::user()->address) }}</textarea>
                                @error('address')
                                <div>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender"
                                    class="form-control custom-select @error('gender') is-invalid  @enderror">
                                    <option>Select one</option>
                                    <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male
                                    </option>
                                    <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female
                                    </option>

                                </select>
                                @error('gender')
                                <div>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" name="role" id="role" class="form-control"
                                    value="{{ Auth::user()->role }}" disabled>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('user#accountDetails') }}" class="btn btn-secondary">Cancel</a>

                            <input type="submit" value="Save Changes" class="btn btn-success float-right">

                        </div>
                    </div>
                </form>

            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection